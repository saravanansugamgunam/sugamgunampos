<!DOCTYPE html>
<?php
include("../../connect.php");
?>
<html>

<head>
    <title>Capsule Cost Calculator</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Libraries -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .result-box {
            margin-top: 20px;
            padding: 15px;
            background: #e9ecef;
            border-radius: 5px;
        }

        table th,
        table td {
            vertical-align: middle;
        }

        .remove-btn {
            margin-top: 32px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Production Estimate - Calculator</h2>
        <form id="costForm">

        <div class="form-group">
                <label for="medicineForm">Form of Medicine</label>
                <select class="form-control" id="medicineForm" name="medicineForm" required>
                <?php
                                $sqli = "SELECT medicineformid,formname FROM production_medicineform 
                                where  activestatus ='Active' order by formname";
                                $result = mysqli_query($connection, $sqli);
                                while ($row = mysqli_fetch_array($result)) {
                                    # code...

                                    echo ' <option value=' . $row['medicineformid'] . '>' . $row['formname'] . '</option>';
                                }
                                ?>
                </select>
            </div>


            <div id="ingredientContainer">
                <div class="form-row ingredient-row mb-3">
                    <div class="col">
                        <select class="form-control ingredient-select" name="ingredient[]" required></select>
                    </div>
                    <div class="col">
                        <input type="number" step="0.01" class="form-control" name="costPerGram[]" placeholder="Cost/g" required>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" name="combCapValue[]" placeholder="Comb/Cap" required>
                            <select class="form-control combUnit" name="combCapUnit[]">
                                <option value="mg">mg</option>
                                <option value="percent">%</option>
                            </select>
                        </div>
                        <small class="form-text text-muted percent-info" style="display:none;">
                            Adjusted: <span class="adjusted-percent">0%</span>
                        </small>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-danger remove-btn" onclick="removeIngredient(this)">Remove</button>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-secondary mb-3" onclick="addIngredient()">+ Add Ingredient</button>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Total Capsules</label>
                    <input type="number" class="form-control" id="capsuleCount" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Capsule Weight (mg)</label>
                    <input type="number" class="form-control" id="capsuleWeight" value="500" required>
                    <small class="form-text text-muted">Used for % based combination calculation</small>
                </div>
            </div>

            <div class="form-group">
                <label>M Factor (Multiplier)</label>
                <input type="number" step="0.1" class="form-control" id="mFactor" value="9" required>
            </div>

            <button type="submit" class="btn btn-primary">Calculate</button>
        </form>

        <div id="results" class="result-box mt-4" style="display:none">
            <h5>Ingredient Breakdown</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ingredient</th>
                        <th>Required Grams</th>
                        <th>Cost (₹)</th>
                        <th>Comb (%)</th>
                    </tr>
                </thead>
                <tbody id="resultTable"></tbody>
            </table>
            <p><strong>Total Raw Material Cost (₹):</strong> <span id="totalRawCost"></span></p>
            <p><strong>Estimated MRP (₹):</strong> <span id="estimatedMRP"></span></p>
            <p><strong>Cost per Capsule (₹):</strong> <span id="costPerCapsule"></span></p>
            <button class="btn btn-success" onclick="downloadExcel()">Export to Excel</button>
        </div>
    </div>

    <script>
        function initializeSelect2() {
            $('.ingredient-select').select2({
                tags: true,
                placeholder: 'Select or type ingredient',
                ajax: {
                    url: 'Load/SpecialMedicine/fetch_ingredients.php',
                    dataType: 'json',
                    delay: 250,
                    data: params => ({ term: params.term }),
                    processResults: data => ({
                        results: data.map(item => ({ id: item.id, text: item.text, cost: item.cost }))
                    })
                },
                minimumInputLength: 1,
                templateResult: function(data) {
                    if (data.loading) return data.text;
                    if (!data.cost && data.id === data.text) return $('<span style="color: green;">New: ' + data.text + '</span>');
                    return $('<span>' + data.text + ' <small style="color:#888;">(₹' + data.cost + '/g)</small></span>');
                }
            }).on('select2:select', function(e) {
                const selected = e.params.data;
                const $row = $(this).closest('.ingredient-row');
                const cost = (selected.cost !== undefined) ? selected.cost : 0;
                $row.find('input[name="costPerGram[]"]').val(cost);
            });
        }

        $(document).ready(function() {
            initializeSelect2();
            updateAdjustedPercentages();

            $(document).on('input change', 'input[name="combCapValue[]"], select[name="combCapUnit[]"], #capsuleWeight', function () {
                updateAdjustedPercentages();
            });
        });

        function addIngredient() {
            const row = document.createElement('div');
            row.className = 'form-row ingredient-row mb-3';
            row.innerHTML = `
                <div class="col">
                    <select class="form-control ingredient-select" name="ingredient[]" required></select>
                </div>
                <div class="col">
                    <input type="number" step="0.01" class="form-control" name="costPerGram[]" placeholder="Cost/g" required>
                </div>
                <div class="col">
                    <div class="input-group">
                        <input type="number" step="0.01" class="form-control" name="combCapValue[]" placeholder="Comb/Cap" required>
                        <select class="form-control combUnit" name="combCapUnit[]">
                            <option value="mg">mg</option>
                            <option value="percent">%</option>
                        </select>
                    </div>
                    <small class="form-text text-muted percent-info" style="display:none;">
                        Adjusted: <span class="adjusted-percent">0%</span>
                    </small>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-danger remove-btn" onclick="removeIngredient(this)">Remove</button>
                </div>`;
            document.getElementById('ingredientContainer').appendChild(row);
            initializeSelect2();
            updateAdjustedPercentages();
        }

        function removeIngredient(button) {
            button.closest('.ingredient-row').remove();
            updateAdjustedPercentages();
        }

        function updateAdjustedPercentages() {
            const $rows = $('.ingredient-row');
            let totalPercent = 0;
            const percentInputs = [];

            $rows.each(function () {
                const unit = $(this).find('select[name="combCapUnit[]"]').val();
                const val = parseFloat($(this).find('input[name="combCapValue[]"]').val()) || 0;
                if (unit === 'percent') {
                    totalPercent += val;
                    percentInputs.push({ row: $(this), value: val });
                } else {
                    $(this).find('.percent-info').hide();
                }
            });

            percentInputs.forEach(entry => {
                const adjusted = totalPercent > 0 ? (entry.value / totalPercent) * 100 : 0;
                entry.row.find('.adjusted-percent').text(adjusted.toFixed(2) + '%');
                entry.row.find('.percent-info').show();
            });
        }

        document.getElementById('costForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            const ingredients = formData.getAll('ingredient[]');
            const costs = formData.getAll('costPerGram[]').map(Number);
            const combValues = formData.getAll('combCapValue[]').map(Number);
            const combUnits = formData.getAll('combCapUnit[]');
            const count = parseInt(document.getElementById('capsuleCount').value);
            const capsuleWeight = parseFloat(document.getElementById('capsuleWeight').value);
            const mFactor = parseFloat(document.getElementById('mFactor').value);

            let totalRaw = 0;
            let rows = [];
            let combMgArray = [];

            // Auto-balance % inputs
            let totalPercent = 0;
            for (let i = 0; i < combUnits.length; i++) {
                if (combUnits[i] === 'percent') totalPercent += combValues[i];
            }

            for (let i = 0; i < combValues.length; i++) {
                let mg = combValues[i];
                if (combUnits[i] === 'percent') {
                    const adjustedPercent = (mg / totalPercent) * 100;
                    mg = (adjustedPercent / 100) * capsuleWeight;
                    combValues[i] = adjustedPercent;
                }
                combMgArray.push(mg);
            }

            const totalMg = combMgArray.reduce((a, b) => a + b, 0);

            for (let i = 0; i < ingredients.length; i++) {
                const mg = combMgArray[i];
                const grams = (mg * count) / 1000;
                const cost = grams * costs[i];
                const percent = ((mg / totalMg) * 100).toFixed(2);
                totalRaw += cost;

                rows.push(`<tr>
                    <td>${ingredients[i]}</td>
                    <td>${grams.toFixed(2)}</td>
                    <td>${cost.toFixed(2)}</td>
                    <td>${percent}%</td>
                </tr>`);
            }

            document.getElementById('resultTable').innerHTML = rows.join('');
            document.getElementById('totalRawCost').innerText = totalRaw.toFixed(2);
            document.getElementById('estimatedMRP').innerText = (totalRaw * mFactor).toFixed(2);
            document.getElementById('costPerCapsule').innerText = (totalRaw / count).toFixed(2);
            document.getElementById('results').style.display = 'block';
        });

        function downloadExcel() {
            const table = document.getElementById('resultTable');
            let csv = 'Ingredient,Required Grams,Cost (₹),Comb (%)\n';
            for (let row of table.rows) {
                const cells = [...row.cells].map(cell => cell.innerText);
                csv += cells.join(',') + '\n';
            }
            csv += `\nTotal Raw Cost,,${document.getElementById('totalRawCost').innerText}`;
            csv += `\nEstimated MRP,,${document.getElementById('estimatedMRP').innerText}`;
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'capsule_cost_estimate.csv';
            a.click();
        }
    </script>
</body>

</html>
