<?php
require_once 'connect.php';

$doctor = 'Prof. Raja Sheik Peer';

$days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
$locations = ['Annanagar','Vadaperumbakkam'];
$slots = ['Morning','Evening','Special'];

$schedule = [];
foreach ($days as $d) {
  foreach ($locations as $loc) {
    foreach ($slots as $slot) {
      $schedule[$d][$loc][$slot] = null;
    }
  }
}

$stmt = $connection->prepare("
  SELECT day_name, location, slot, start_time, end_time
  FROM doctor_schedule
  WHERE doctor = ?
");
$stmt->bind_param('s', $doctor);
$stmt->execute();
$res = $stmt->get_result();
while ($row = $res->fetch_assoc()) {
  $d = $row['day_name'];
  $loc = $row['location'];
  $slot = $row['slot'];
  $schedule[$d][$loc][$slot] = [
    'start' => $row['start_time'] ? date('h:i A', strtotime($row['start_time'])) : null,
    'end'   => $row['end_time']   ? date('h:i A', strtotime($row['end_time']))   : null,
  ];
}
$stmt->close();

function fmtSlot($s) {
  return ($s && $s['start'] && $s['end']) ? ($s['start'].' – '.$s['end']) : '—';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctor's Schedule</title>
    <style>
    :root {
        --ink: #1e293b;
        --muted: #64748b;
        --line: #e5e7eb;
        --brand: #126E70;
        /* teal from logo */
        --accent: #9C5323;
        /* earthy brown from logo */
        --whatsapp: #25D366;
        --anna: #126E70;
        /* Annanagar - teal */
        --vada: #9C5323;
        /* Vadaperumbakkam - brown */
        --anna-soft: #e1f4f4;
        /* tinted teal */
        --vada-soft: #f5ebe4;
        /* tinted brown */
    }

    * {
        box-sizing: border-box
    }

    body {
        margin: 0;
        font-family: Arial, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, "Helvetica Neue";
        color: var(--ink);
        background: #fff
    }

    .page {
        max-width: 1180px;
        margin: 22px auto;
        padding: 0 16px
    }

    .hero{
  background:var(--brand);
  color:#fff;
  padding:20px;
  border-radius:14px;
  display:flex;
  align-items:center;
  justify-content:space-between; /* pushes logo to right */
  gap:16px;
}


    .hero img {
        height: 60px
    }

    .hero h1 {
        margin: 0;
        font-size: 28px
    }

    .hero small {
        opacity: .95
    }

    .section {
        display: flex;
        gap: 18px;
        margin-top: 18px;
        align-items: stretch
    }

    .photo {
        flex: 0 0 340px;
        background: #f8f8f8;
        border: 1px solid var(--line);
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 340px;
    }

    .photo img {
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    .content {
        flex: 1;
        min-width: 0
    }

    .note {
        margin: 12px 0;
        color: #555
    }

    table {
        width: 100%;
        border-collapse: collapse
    }

    th,
    td {
        border: 1px solid var(--line);
        padding: 12px;
        text-align: center
    }

    thead tr:first-child th {
        background: var(--brand);
        color: #fff;
        font-weight: bold
    }

    .head-anna {
        background: var(--anna);
        color: #fff
    }

    .head-vada {
        background: var(--vada);
        color: #fff
    }

    tbody td {
        font-size: 15px
    }

    .cell-anna {
        background: var(--anna-soft)
    }

    .cell-vada {
        background: var(--vada-soft)
    }

    .footer {
        margin-top: 18px;
        padding: 14px;
        background: #f6f6f6;
        border-radius: 12px;
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap
    }

    .footer strong {
        color: var(--brand)
    }

    .btn {
        display: inline-block;
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none
    }

    .btn-book {
        background: var(--brand);
        color: #fff
    }

    .btn-wa {
        background: var(--whatsapp);
        color: #fff
    }

    @media (max-width:900px) {
        .section {
            flex-direction: column
        }

        .photo {
            flex: 0 0 auto;
            height: 300px
        }
    }
    </style>
</head>

<body>
    <div class="page">

        <div class="hero">
            <div style="flex:1">
                <h1><?= htmlspecialchars($doctor) ?></h1>
                <small>Doctor's Schedule</small>
            </div>
            <img src="assets/img/logoreverse.png" alt="Sugamgunam Logo" style="height:60px;" />
        </div>


        <div class="section">
            <!-- Left: doctor photo -->
            <aside class="photo">
                <img src="assets/img/rajasheikpeer.png" alt="Doctor photo" />
            </aside>

            <!-- Right: schedule table -->
            <main class="content">
                <p class="note">Note: The schedule may be subject to change.
                </p>

                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">Day</th>
                            <th colspan="2">Annanagar</th>
                            <th colspan="2">Vadaperumbakkam</th>
                        </tr>
                        <tr>
                            <th class="head-anna">Morning</th>
                            <th class="head-anna">Evening</th>
                            <th class="head-vada">Morning</th>
                            <th class="head-vada">Evening</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($days as $day): ?>
                        <?php
              $aM = $schedule[$day]['Annanagar']['Morning'];
              $aE = $schedule[$day]['Annanagar']['Evening'];
              $aS = $schedule[$day]['Annanagar']['Special'];

              $vM = $schedule[$day]['Vadaperumbakkam']['Morning'];
              $vE = $schedule[$day]['Vadaperumbakkam']['Evening'];
              $vS = $schedule[$day]['Vadaperumbakkam']['Special'];

              $annaSpecial = !empty($aS);
              $vadaSpecial = !empty($vS);
            ?>
                        <tr>
                            <td><?= $day ?></td>

                            <?php if ($annaSpecial): ?>
                            <td class="cell-anna" colspan="2"><strong>Special Appointment</strong></td>
                            <?php else: ?>
                            <td class="<?= $aM?'cell-anna':'' ?>"><?= fmtSlot($aM) ?></td>
                            <td class="<?= $aE?'cell-anna':'' ?>"><?= fmtSlot($aE) ?></td>
                            <?php endif; ?>

                            <?php if ($vadaSpecial): ?>
                            <td class="cell-vada" colspan="2"><strong>Special Appointment</strong></td>
                            <?php else: ?>
                            <td class="<?= $vM?'cell-vada':'' ?>"><?= fmtSlot($vM) ?></td>
                            <td class="<?= $vE?'cell-vada':'' ?>"><?= fmtSlot($vE) ?></td>
                            <?php endif; ?>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="footer">
                    <p>To schedule an appointment, call <strong>9176606308</strong> or visit
                        <strong>www.sugamgunam.com</strong></p>
                    <div>
                        <a href="https://www.sugamgunam.com/appointment/apio/" class="btn btn-book">Book Now</a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>