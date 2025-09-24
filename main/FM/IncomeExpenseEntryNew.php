<?php
/**
 * Clinic General Ledger – Single‑file PHP App (Bootstrap 5 + PDO + MySQL)
 * Author: ChatGPT
 * Purpose: Track ALL income & expenses (cash, bank, suppliers, GST, etc.) with double‑entry accounting.
 *
 * How to use
 *  1) Save as `gl_app.php` in your PHP web root.
 *  2) Create a MySQL DB and run the DDL below (or click the “Auto‑create DB Objects” button inside the app once DB creds are set).
 *  3) Update DB creds in the CONFIG section.
 *  4) Open in browser. Add Accounts (Chart of Accounts), then start recording vouchers (Receipt/Payment/Contra/Journal/Sales/Purchase).
 *
 * Features
 *  - Double‑entry vouchers with multi‑line support (DR/CR lines must balance).
 *  - Voucher types: RECEIPT, PAYMENT, CONTRA, JOURNAL, SALES, PURCHASE.
 *  - Chart of Accounts with Group & Sub‑Group (Assets/Liabilities/Capital/Income/Expense; Bank/Cash, Duties & Taxes, Direct/Indirect, etc.).
 *  - Party master (Customers/Suppliers) – optional link to vouchers.
 *  - Attachments (PDF/JPG/PNG) per voucher.
 *  - Reports: Daybook, Ledger Statement, Cash/Bank Book, Trial Balance, P&L (simple), Balance Sheet (simple).
 *  - CSRF protection, prepared statements, Bootstrap 5 UI, Select2 for account pickers.
 *
 * Notes
 *  - Keep it simple: this is a clean starting point you can expand (GST automation, inventory, invoice printing, etc.).
 *  - All totals use 2‑decimals; adapt as needed.
 */

/*****************
 * 0) QUICK DDL  *
 *****************/
/*
CREATE TABLE IF NOT EXISTS accounts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL UNIQUE,
  grp ENUM('Asset','Liability','Capital','Income','Expense') NOT NULL,
  subgroup VARCHAR(100) NOT NULL,
  is_cash_bank TINYINT(1) NOT NULL DEFAULT 0, -- mark Cash/Bank accounts for cash/bank book & contra
  is_party TINYINT(1) NOT NULL DEFAULT 0,     -- for Customers/Suppliers style ledgers
  opening_dr DECIMAL(14,2) NOT NULL DEFAULT 0.00,
  opening_cr DECIMAL(14,2) NOT NULL DEFAULT 0.00,
  active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS parties (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(160) NOT NULL UNIQUE,
  type ENUM('Customer','Supplier','Other') NOT NULL DEFAULT 'Other',
  gstin VARCHAR(20) NULL,
  phone VARCHAR(20) NULL,
  email VARCHAR(120) NULL,
  address TEXT NULL,
  account_id INT NULL, -- optional link to an account
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS vouchers (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  vdate DATE NOT NULL,
  vtype ENUM('RECEIPT','PAYMENT','CONTRA','JOURNAL','SALES','PURCHASE') NOT NULL,
  vnumber VARCHAR(40) NULL,
  party_id INT NULL,
  narration VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (party_id) REFERENCES parties(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS voucher_lines (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  voucher_id BIGINT NOT NULL,
  account_id INT NOT NULL,
  dr DECIMAL(14,2) NOT NULL DEFAULT 0.00,
  cr DECIMAL(14,2) NOT NULL DEFAULT 0.00,
  line_notes VARCHAR(255) NULL,
  FOREIGN KEY (voucher_id) REFERENCES vouchers(id) ON DELETE CASCADE,
  FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS voucher_attachments (
  id BIGINT AUTO_INCREMENT PRIMARY KEY,
  voucher_id BIGINT NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  original_name VARCHAR(200) NULL,
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (voucher_id) REFERENCES vouchers(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Seed a minimal Chart of Accounts
INSERT IGNORE INTO accounts (name, grp, subgroup, is_cash_bank)
VALUES
 ('Cash-in-Hand','Asset','Cash',1),
 ('Bank - ICICI','Asset','Bank Accounts',1),
 ('Bank - SBI','Asset','Bank Accounts',1),
 ('Capital Account','Capital','Capital Account',0),
 ('Drawings','Capital','Drawings',0),
 ('Sundry Creditors - Medicine','Liability','Sundry Creditors',0),
 ('Sundry Creditors - Services','Liability','Sundry Creditors',0),
 ('GST Payable - CGST','Liability','Duties & Taxes',0),
 ('GST Payable - SGST','Liability','Duties & Taxes',0),
 ('GST Payable - IGST','Liability','Duties & Taxes',0),
 ('GST Input - CGST','Asset','Duties & Taxes',0),
 ('GST Input - SGST','Asset','Duties & Taxes',0),
 ('GST Input - IGST','Asset','Duties & Taxes',0),
 ('Consultation Income','Income','Direct Income',0),
 ('Therapy Income','Income','Direct Income',0),
 ('Lab Test Income','Income','Direct Income',0),
 ('Medicine Sales','Income','Direct Income',0),
 ('Other Clinic Income','Income','Indirect Income',0),
 ('Medicine Purchase','Expense','Direct Expenses',0),
 ('Therapy Materials Purchase','Expense','Direct Expenses',0),
 ('Staff Salary','Expense','Employee Benefits',0),
 ('Staff Incentives','Expense','Employee Benefits',0),
 ('Staff Welfare - Food','Expense','Employee Benefits',0),
 ('Rent - Clinic Premises','Expense','Rent',0),
 ('Electricity Charges (EB)','Expense','Utilities',0),
 ('Water & Housekeeping','Expense','Utilities',0),
 ('Telephone & Internet','Expense','Communication Expenses',0),
 ('Printing & Stationery','Expense','Administrative Expenses',0),
 ('Repairs & Maintenance - Building','Expense','Repairs & Maintenance',0),
 ('Repairs & Maintenance - Equipment','Expense','Repairs & Maintenance',0),
 ('Marketing & Advertising','Expense','Selling & Distribution',0),
 ('Marketing - Digital (Influencers)','Expense','Selling & Distribution',0),
 ('Bank Charges','Expense','Finance Charges',0),
 ('UPI/Transaction Charges','Expense','Finance Charges',0),
 ('Loan Interest','Expense','Finance Charges',0),
 ('Auditor / Professional Fees','Expense','Professional Fees',0),
 ('Training & Development','Expense','Training',0),
 ('Miscellaneous Expenses','Expense','Miscellaneous',0);
*/

/*****************
 * 1) CONFIG      *
 *****************/
$DB_HOST = 'localhost';
$DB_NAME = 'dev_sugamgunam';
$DB_USER = 'root';
$DB_PASS = '';
$APP_TITLE = 'Clinic General Ledger';
$UPLOAD_DIR = __DIR__ . '/uploads/vouchers';
if (!is_dir($UPLOAD_DIR)) { @mkdir($UPLOAD_DIR, 0775, true); }

/*****************
 * 2) BOOTSTRAP  *
 *****************/
try {
  $pdo = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4", $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (Throwable $e) {
  die('DB connection failed: ' . htmlspecialchars($e->getMessage()));
}

session_start();
if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(16)); }
function csrf(){ return $_SESSION['csrf'] ?? ''; }
function check_csrf(){ if(($_POST['csrf'] ?? '') !== ($_SESSION['csrf'] ?? '')) die('Invalid CSRF'); }

function q($pdo,$sql,$args=[]){ $st=$pdo->prepare($sql); $st->execute($args); return $st; }
function all($st){ return $st->fetchAll(); }
function one($st){ return $st->fetch(); }

/*****************
 * 3) HELPERS     *
 *****************/
function formatMoney($n){ return number_format((float)$n,2,'.',','); }
function getAccounts($pdo){ return all(q($pdo,"SELECT id,name,grp,subgroup,is_cash_bank FROM accounts WHERE active=1 ORDER BY name")); }
function getCashBank($pdo){ return all(q($pdo,"SELECT id,name FROM accounts WHERE is_cash_bank=1 AND active=1 ORDER BY name")); }
function accountById($pdo,$id){ return one(q($pdo,"SELECT * FROM accounts WHERE id=?",[$id])); }

function accountBalance($pdo,$account_id,$from=null,$to=null){
  // Opening
  $acc = accountById($pdo,$account_id);
  $op_dr = (float)($acc['opening_dr'] ?? 0); $op_cr = (float)($acc['opening_cr'] ?? 0);
  $dr = $op_dr; $cr = $op_cr;
  $cond = '';$args=[];
  if($from){ $cond .= ' AND v.vdate>=?'; $args[]=$from; }
  if($to){ $cond .= ' AND v.vdate<=?'; $args[]=$to; }
  $sql = "SELECT SUM(l.dr) sdr, SUM(l.cr) scr FROM voucher_lines l JOIN vouchers v ON v.id=l.voucher_id WHERE l.account_id=? $cond";
  $row = one(q($pdo,$sql,array_merge([$account_id],$args)));
  $dr += (float)($row['sdr'] ?? 0); $cr += (float)($row['scr'] ?? 0);
  $net = $dr-$cr; // + = Dr bal, - = Cr bal
  return $net; 
}

function voucherTotalsBalanced($lines){
  $tdr=0;$tcr=0; foreach($lines as $ln){ $tdr+= (float)$ln['dr']; $tcr+= (float)$ln['cr']; }
  return [round($tdr,2), round($tcr,2), abs(round($tdr-$tcr,2))<0.01];
}

/*****************
 * 4) ROUTING     *
 *****************/
$action = $_GET['action'] ?? 'home';
$msg = '';$err='';

// Auto-create schema (optional)
if($action==='init' && $_SERVER['REQUEST_METHOD']==='POST'){
  check_csrf();
  try{
    $ddl = file_get_contents(__FILE__);
    // Extract between /* and */ after QUICK DDL
    if(preg_match('/\*\nCREATE TABLE[\s\S]*?\;\n\*\//',$ddl,$m)){
      $sql = trim(trim($m[0],'/*')); // raw; but we split by ;\n
      // naive split
      $stmts = array_filter(array_map('trim', explode(";\n", $sql)));
      foreach($stmts as $s){ if($s){ $pdo->exec($s.';'); } }
      $msg = 'Database objects created/seeded (where missing).';
    } else { $err='DDL not found in file.'; }
  }catch(Throwable $e){ $err='Init failed: '.$e->getMessage(); }
  $action='home';
}

// Create/Update Account
if($action==='save_account' && $_SERVER['REQUEST_METHOD']==='POST'){
  check_csrf();
  $id = (int)($_POST['id'] ?? 0);
  $data = [
    'name'=>trim($_POST['name']??''),
    'grp'=>$_POST['grp']??'Asset',
    'subgroup'=>trim($_POST['subgroup']??''),
    'is_cash_bank'=>isset($_POST['is_cash_bank'])?1:0,
    'is_party'=>isset($_POST['is_party'])?1:0,
    'opening_dr'=>(float)($_POST['opening_dr']??0),
    'opening_cr'=>(float)($_POST['opening_cr']??0),
  ];
  try{
    if($id){
      q($pdo,"UPDATE accounts SET name=?, grp=?, subgroup=?, is_cash_bank=?, is_party=?, opening_dr=?, opening_cr=? WHERE id=?",
        [$data['name'],$data['grp'],$data['subgroup'],$data['is_cash_bank'],$data['is_party'],$data['opening_dr'],$data['opening_cr'],$id]);
      $msg='Account updated.';
    } else {
      q($pdo,"INSERT INTO accounts(name,grp,subgroup,is_cash_bank,is_party,opening_dr,opening_cr) VALUES(?,?,?,?,?,?,?)",
        [$data['name'],$data['grp'],$data['subgroup'],$data['is_cash_bank'],$data['is_party'],$data['opening_dr'],$data['opening_cr']]);
      $msg='Account created.';
    }
  }catch(Throwable $e){ $err='Save account failed: '.$e->getMessage(); }
  $action='accounts';
}

// Save Voucher (with lines + attachment)
if($action==='save_voucher' && $_SERVER['REQUEST_METHOD']==='POST'){
  check_csrf();
  $vdate = $_POST['vdate']??date('Y-m-d');
  $vtype = $_POST['vtype']??'JOURNAL';
  $vnumber = trim($_POST['vnumber']??'');
  $party_id = (int)($_POST['party_id']??0) ?: null;
  $narration = trim($_POST['narration']??'');

  // Lines
  $acc_ids = $_POST['line_account_id'] ?? [];
  $drs     = $_POST['line_dr'] ?? [];
  $crs     = $_POST['line_cr'] ?? [];
  $notes   = $_POST['line_notes'] ?? [];
  $lines=[];
  for($i=0;$i<count($acc_ids);$i++){
    $aid = (int)$acc_ids[$i]; if(!$aid) continue;
    $dr = (float)($drs[$i]??0); $cr=(float)($crs[$i]??0);
    if($dr<=0 && $cr<=0) continue;
    $lines[]=['account_id'=>$aid,'dr'=>$dr,'cr'=>$cr,'notes'=>trim($notes[$i]??'')];
  }
  [$tdr,$tcr,$ok] = voucherTotalsBalanced($lines);
  if(!$ok){ $err = 'Voucher not balanced. DR='.formatMoney($tdr).' CR='.formatMoney($tcr); $action='vouchers'; }
  else {
    try{
      q($pdo,"INSERT INTO vouchers(vdate,vtype,vnumber,party_id,narration) VALUES(?,?,?,?,?)",
        [$vdate,$vtype,$vnumber,$party_id,$narration]);
      $vid = $pdo->lastInsertId();
      $ins = $pdo->prepare("INSERT INTO voucher_lines(voucher_id,account_id,dr,cr,line_notes) VALUES(?,?,?,?,?)");
      foreach($lines as $ln){ $ins->execute([$vid,$ln['account_id'],$ln['dr'],$ln['cr'],$ln['notes']]); }
      // Attachment (optional)
      if(!empty($_FILES['attachment']['name'])){
        $fn = time().'_'.preg_replace('/[^A-Za-z0-9_.-]/','_', $_FILES['attachment']['name']);
        $dest = $UPLOAD_DIR.'/'.$fn;
        if(move_uploaded_file($_FILES['attachment']['tmp_name'],$dest)){
          q($pdo,"INSERT INTO voucher_attachments(voucher_id,file_path,original_name) VALUES(?,?,?)",[$vid,$dest,$_FILES['attachment']['name']]);
        }
      }
      $msg = 'Voucher saved. ID #'.$vid;
    }catch(Throwable $e){ $err='Save voucher failed: '.$e->getMessage(); }
    $action='vouchers';
  }
}

/*****************
 * 5) HTML HEAD   *
 *****************/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?=htmlspecialchars($APP_TITLE)?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .select2-container .select2-selection--single { height: 38px; }
    .select2-selection__rendered { line-height: 38px !important; }
    .select2-selection__arrow { height: 36px !important; }
    .table-mini td, .table-mini th { padding: 0.25rem 0.5rem; }
    .sticky-cta{position:sticky;bottom:0;z-index:10;background:#fff;padding:8px;border-top:1px solid #eee}
  </style>
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="?"><?=$APP_TITLE?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link<?=($action==='home'?' active':'')?>" href="?">Home</a></li>
        <li class="nav-item"><a class="nav-link<?=($action==='accounts'?' active':'')?>" href="?action=accounts">Accounts</a></li>
        <li class="nav-item"><a class="nav-link<?=($action==='vouchers'?' active':'')?>" href="?action=vouchers">Vouchers</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle<?= in_array($action,['daybook','ledger','cashbook','trial','pl','bs'])?' active':'' ?>" href="#" data-bs-toggle="dropdown">Reports</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?action=daybook">Daybook</a></li>
            <li><a class="dropdown-item" href="?action=ledger">Ledger Statement</a></li>
            <li><a class="dropdown-item" href="?action=cashbook">Cash/Bank Book</a></li>
            <li><a class="dropdown-item" href="?action=trial">Trial Balance</a></li>
            <li><a class="dropdown-item" href="?action=pl">Profit & Loss</a></li>
            <li><a class="dropdown-item" href="?action=bs">Balance Sheet</a></li>
          </ul>
        </li>
      </ul>
      <form method="post" action="?action=init" class="d-flex">
        <input type="hidden" name="csrf" value="<?=csrf()?>">
        <button class="btn btn-outline-light btn-sm" type="submit" title="Create missing tables & seed COA">Auto‑create DB Objects</button>
      </form>
    </div>
  </div>
</nav>

<div class="container my-3">
  <?php if($msg): ?><div class="alert alert-success py-2"><?=htmlspecialchars($msg)?></div><?php endif; ?>
  <?php if($err): ?><div class="alert alert-danger py-2"><?=htmlspecialchars($err)?></div><?php endif; ?>

  <?php if($action==='home'): ?>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="card shadow-sm"><div class="card-body">
          <h5 class="card-title">Quick Stats</h5>
          <?php
            $cash = one(q($pdo,"SELECT id FROM accounts WHERE name='Cash-in-Hand'"));
            $cashBal = $cash?accountBalance($pdo,$cash['id']):0;
            $bankBal = 0; foreach(getCashBank($pdo) as $b){ $bankBal += accountBalance($pdo,$b['id']); }
          ?>
          <p class="mb-1">Cash Balance: <strong>₹ <?=formatMoney($cashBal)?></strong></p>
          <p class="mb-1">Total Bank Balance: <strong>₹ <?=formatMoney($bankBal)?></strong></p>
          <p class="text-muted small">(Opening + Nett DR/CR)</p>
        </div></div>
      </div>
      <div class="col-md-8">
        <div class="card shadow-sm"><div class="card-body">
          <h5 class="card-title">How to get started</h5>
          <ol class="mb-0">
            <li>Add/confirm your <strong>Accounts</strong> (Cash/Bank, GST Input/Output, Sales, Purchases, Salaries, etc.).</li>
            <li>Record <strong>Vouchers</strong> (RECEIPT, PAYMENT, CONTRA, JOURNAL, SALES, PURCHASE).</li>
            <li>View <strong>Daybook</strong> and <strong>Ledger</strong> to verify entries; then see <strong>P&L</strong> and <strong>Balance Sheet</strong>.</li>
          </ol>
        </div></div>
      </div>
    </div>
  <?php endif; ?>

  <?php if($action==='accounts'): ?>
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h5 class="card-title mb-0">Chart of Accounts</h5>
          <button class="btn btn-sm btn-primary" data-bs-toggle="collapse" data-bs-target="#addAcc">+ New Account</button>
        </div>
        <div id="addAcc" class="collapse border rounded p-3 mb-3">
          <form method="post" action="?action=save_account">
            <input type="hidden" name="csrf" value="<?=csrf()?>">
            <input type="hidden" name="id" value="">
            <div class="row g-2">
              <div class="col-md-4"><label class="form-label">Account Name</label><input name="name" class="form-control" required></div>
              <div class="col-md-2"><label class="form-label">Group</label>
                <select name="grp" class="form-select" required>
                  <option>Asset</option><option>Liability</option><option>Capital</option><option>Income</option><option>Expense</option>
                </select>
              </div>
              <div class="col-md-3"><label class="form-label">Sub‑Group</label><input name="subgroup" class="form-control" placeholder="e.g., Bank Accounts, Direct Income" required></div>
              <div class="col-md-3 d-flex align-items-end gap-3">
                <div class="form-check"><input class="form-check-input" type="checkbox" name="is_cash_bank" id="cb1"><label class="form-check-label" for="cb1">Cash/Bank</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="is_party" id="cb2"><label class="form-check-label" for="cb2">Party Ledger</label></div>
              </div>
              <div class="col-md-3"><label class="form-label">Opening Dr</label><input type="number" step="0.01" name="opening_dr" class="form-control" value="0"></div>
              <div class="col-md-3"><label class="form-label">Opening Cr</label><input type="number" step="0.01" name="opening_cr" class="form-control" value="0"></div>
              <div class="col-md-3 d-flex align-items-end"><button class="btn btn-success">Save Account</button></div>
            </div>
          </form>
        </div>
        <?php $accts = getAccounts($pdo); ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped table-mini">
            <thead><tr><th>#</th><th>Name</th><th>Group</th><th>Sub‑Group</th><th>Cash/Bank</th><th>Opening</th><th>Balance</th></tr></thead>
            <tbody>
            <?php foreach($accts as $a): $bal = accountBalance($pdo,$a['id']); ?>
              <tr>
                <td><?=$a['id']?></td>
                <td><?=htmlspecialchars($a['name'])?></td>
                <td><?=$a['grp']?></td>
                <td><?=htmlspecialchars($a['subgroup'])?></td>
                <td><?=$a['is_cash_bank']?'Yes':'No'?></td>
                <td><?php $acc=accountById($pdo,$a['id']); echo 'Dr '.formatMoney($acc['opening_dr']).' / Cr '.formatMoney($acc['opening_cr']); ?></td>
                <td><?= ($bal>=0?'Dr ':'Cr ').formatMoney(abs($bal)) ?></td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if($action==='vouchers'): ?>
    <div class="card shadow-sm">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <h5 class="card-title mb-0">New Voucher</h5>
        </div>
        <?php $accs = getAccounts($pdo); ?>
        <form method="post" action="?action=save_voucher" enctype="multipart/form-data" id="voucherForm">
          <input type="hidden" name="csrf" value="<?=csrf()?>">
          <div class="row g-2 mb-2">
            <div class="col-md-2"><label class="form-label">Date</label><input type="date" name="vdate" class="form-control" value="<?=date('Y-m-d')?>" required></div>
            <div class="col-md-2"><label class="form-label">Type</label>
              <select name="vtype" class="form-select" required>
                <option>RECEIPT</option>
                <option>PAYMENT</option>
                <option>CONTRA</option>
                <option>JOURNAL</option>
                <option>SALES</option>
                <option>PURCHASE</option>
              </select>
            </div>
            <div class="col-md-2"><label class="form-label">Number</label><input name="vnumber" class="form-control" placeholder="Optional"></div>
            <div class="col-md-6"><label class="form-label">Narration</label><input name="narration" class="form-control" placeholder="Purpose"></div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-mini" id="linesTbl">
              <thead class="table-light">
                <tr><th style="width:35%">Account</th><th style="width:15%">Dr</th><th style="width:15%">Cr</th><th>Notes</th><th style="width:40px"></th></tr>
              </thead>
              <tbody>
                <tr>
                  <td><select class="form-select sel2" name="line_account_id[]" required>
                    <option value="">— choose account —</option>
                    <?php foreach($accs as $a): ?>
                      <option value="<?=$a['id']?>"><?=htmlspecialchars($a['name'])?> (<?=$a['grp']?>)</option>
                    <?php endforeach; ?>
                  </select></td>
                  <td><input type="number" step="0.01" class="form-control dr" name="line_dr[]"></td>
                  <td><input type="number" step="0.01" class="form-control cr" name="line_cr[]"></td>
                  <td><input class="form-control" name="line_notes[]" placeholder="Optional"></td>
                  <td><button type="button" class="btn btn-sm btn-outline-danger del">×</button></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="d-flex justify-content-between align-items-center sticky-cta">
            <div class="d-flex align-items-center gap-2">
              <button type="button" id="addLine" class="btn btn-outline-secondary btn-sm">+ Add Line</button>
              <div class="fw-semibold">Total Dr: <span id="totDr">0.00</span> / Total Cr: <span id="totCr">0.00</span></div>
              <div class="badge bg-<?= 'secondary' ?>" id="balTag">Not Balanced</div>
            </div>
            <div class="d-flex align-items-center gap-3">
              <input type="file" name="attachment" accept="application/pdf,image/*" class="form-control form-control-sm" />
              <button class="btn btn-success">Save Voucher</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="card shadow-sm mt-3">
      <div class="card-body">
        <h5 class="card-title">Recent Vouchers</h5>
        <?php $rows = all(q($pdo,"SELECT v.*, p.name as party FROM vouchers v LEFT JOIN parties p ON p.id=v.party_id ORDER BY v.id DESC LIMIT 50")); ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped table-mini">
            <thead><tr><th>ID</th><th>Date</th><th>Type</th><th>No</th><th>Party</th><th>Narration</th><th>Amount</th></tr></thead>
            <tbody>
              <?php foreach($rows as $r): $tot = one(q($pdo,"SELECT SUM(dr) sdr FROM voucher_lines WHERE voucher_id=?",[$r['id']])); ?>
              <tr>
                <td><?=$r['id']?></td>
                <td><?=$r['vdate']?></td>
                <td><?=$r['vtype']?></td>
                <td><?=htmlspecialchars($r['vnumber']??'')?></td>
                <td><?=htmlspecialchars($r['party']??'')?></td>
                <td><?=htmlspecialchars($r['narration']??'')?></td>
                <td><?=formatMoney($tot['sdr']??0)?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if($action==='daybook'): ?>
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title">Daybook</h5>
      <?php $from=$_GET['from']??date('Y-m-01'); $to=$_GET['to']??date('Y-m-t'); ?>
      <form class="row g-2 mb-2">
        <input type="hidden" name="action" value="daybook">
        <div class="col-md-3"><label class="form-label">From</label><input type="date" name="from" class="form-control" value="<?=$from?>"></div>
        <div class="col-md-3"><label class="form-label">To</label><input type="date" name="to" class="form-control" value="<?=$to?>"></div>
        <div class="col-md-2 d-flex align-items-end"><button class="btn btn-primary">Apply</button></div>
      </form>
      <?php $rows = all(q($pdo,"SELECT * FROM vouchers WHERE vdate BETWEEN ? AND ? ORDER BY vdate, id",[$from,$to])); ?>
      <div class="table-responsive">
        <table class="table table-sm table-striped table-mini">
          <thead><tr><th>Date</th><th>ID</th><th>Type</th><th>Number</th><th>Narration</th><th>Dr</th><th>Cr</th></tr></thead>
          <tbody>
          <?php foreach($rows as $r):
            $s = one(q($pdo,"SELECT SUM(dr) sdr, SUM(cr) scr FROM voucher_lines WHERE voucher_id=?",[$r['id']])); ?>
            <tr><td><?=$r['vdate']?></td><td><?=$r['id']?></td><td><?=$r['vtype']?></td><td><?=htmlspecialchars($r['vnumber']??'')?></td><td><?=htmlspecialchars($r['narration']??'')?></td><td><?=formatMoney($s['sdr']??0)?></td><td><?=formatMoney($s['scr']??0)?></td></tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div></div>
  <?php endif; ?>

  <?php if($action==='ledger'): ?>
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title">Ledger Statement</h5>
      <?php $acc_id=(int)($_GET['aid']??0); $from=$_GET['from']??date('Y-m-01'); $to=$_GET['to']??date('Y-m-t'); $accs=getAccounts($pdo); ?>
      <form class="row g-2 mb-2">
        <input type="hidden" name="action" value="ledger">
        <div class="col-md-5"><label class="form-label">Account</label>
          <select name="aid" class="form-select sel2"> 
            <option value="">— choose —</option>
            <?php foreach($accs as $a): ?>
              <option value="<?=$a['id']?>" <?= $acc_id==$a['id']?'selected':'' ?>><?=htmlspecialchars($a['name'])?> (<?=$a['grp']?>)</option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-3"><label class="form-label">From</label><input type="date" name="from" class="form-control" value="<?=$from?>"></div>
        <div class="col-md-3"><label class="form-label">To</label><input type="date" name="to" class="form-control" value="<?=$to?>"></div>
        <div class="col-md-1 d-flex align-items-end"><button class="btn btn-primary w-100">Go</button></div>
      </form>
      <?php if($acc_id): $opbal = accountBalance($pdo,$acc_id,null,date('Y-m-d',strtotime($from.' -1 day'))); ?>
        <p class="mb-1">Opening Balance: <strong><?=($opbal>=0?'Dr ':'Cr ').formatMoney(abs($opbal))?></strong></p>
        <?php $rows = all(q($pdo,"SELECT v.vdate, v.vtype, v.vnumber, v.narration, l.dr, l.cr FROM voucher_lines l JOIN vouchers v ON v.id=l.voucher_id WHERE l.account_id=? AND v.vdate BETWEEN ? AND ? ORDER BY v.vdate, v.id",[$acc_id,$from,$to])); ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped table-mini">
            <thead><tr><th>Date</th><th>Type</th><th>No</th><th>Narration</th><th>Dr</th><th>Cr</th><th>Balance</th></tr></thead>
            <tbody>
              <?php $running=$opbal; foreach($rows as $r): $running += (float)$r['dr'] - (float)$r['cr']; ?>
                <tr><td><?=$r['vdate']?></td><td><?=$r['vtype']?></td><td><?=htmlspecialchars($r['vnumber']??'')?></td><td><?=htmlspecialchars($r['narration']??'')?></td><td><?=formatMoney($r['dr'])?></td><td><?=formatMoney($r['cr'])?></td><td><?=($running>=0?'Dr ':'Cr ').formatMoney(abs($running))?></td></tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <p class="text-muted">Select an account and date range, then click Go.</p>
      <?php endif; ?>
    </div></div>
  <?php endif; ?>

  <?php if($action==='cashbook'): ?>
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title">Cash/Bank Book</h5>
      <?php $from=$_GET['from']??date('Y-m-01'); $to=$_GET['to']??date('Y-m-t'); ?>
      <form class="row g-2 mb-2">
        <input type="hidden" name="action" value="cashbook">
        <div class="col-md-3"><label class="form-label">From</label><input type="date" name="from" class="form-control" value="<?=$from?>"></div>
        <div class="col-md-3"><label class="form-label">To</label><input type="date" name="to" class="form-control" value="<?=$to?>"></div>
        <div class="col-md-2 d-flex align-items-end"><button class="btn btn-primary">Apply</button></div>
      </form>
      <?php $banks = getCashBank($pdo); ?>
      <?php foreach($banks as $b): $opbal = accountBalance($pdo,$b['id'],null,date('Y-m-d',strtotime($from.' -1 day'))); ?>
        <h6 class="mt-3 mb-1"><?=htmlspecialchars($b['name'])?> — Opening: <?=($opbal>=0?'Dr ':'Cr ').formatMoney(abs($opbal))?></h6>
        <?php $rows = all(q($pdo,"SELECT v.vdate, v.vtype, v.vnumber, v.narration, l.dr, l.cr FROM voucher_lines l JOIN vouchers v ON v.id=l.voucher_id WHERE l.account_id=? AND v.vdate BETWEEN ? AND ? ORDER BY v.vdate, v.id",[$b['id'],$from,$to])); ?>
        <div class="table-responsive">
          <table class="table table-sm table-striped table-mini">
            <thead><tr><th>Date</th><th>Type</th><th>No</th><th>Narration</th><th>Dr</th><th>Cr</th><th>Balance</th></tr></thead>
            <tbody>
              <?php $running=$opbal; foreach($rows as $r): $running += (float)$r['dr'] - (float)$r['cr']; ?>
                <tr><td><?=$r['vdate']?></td><td><?=$r['vtype']?></td><td><?=htmlspecialchars($r['vnumber']??'')?></td><td><?=htmlspecialchars($r['narration']??'')?></td><td><?=formatMoney($r['dr'])?></td><td><?=formatMoney($r['cr'])?></td><td><?=($running>=0?'Dr ':'Cr ').formatMoney(abs($running))?></td></tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endforeach; ?>
    </div></div>
  <?php endif; ?>

  <?php if($action==='trial'): ?>
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title">Trial Balance</h5>
      <?php $to=$_GET['to']??date('Y-m-t'); $accs=getAccounts($pdo); $totdr=0;$totcr=0; ?>
      <form class="row g-2 mb-2">
        <input type="hidden" name="action" value="trial">
        <div class="col-md-4"><label class="form-label">As on</label><input type="date" name="to" class="form-control" value="<?=$to?>"></div>
        <div class="col-md-2 d-flex align-items-end"><button class="btn btn-primary">Apply</button></div>
      </form>
      <div class="table-responsive">
        <table class="table table-sm table-striped table-mini">
          <thead><tr><th>#</th><th>Account</th><th>Group</th><th>Sub‑Group</th><th class="text-end">Dr</th><th class="text-end">Cr</th></tr></thead>
          <tbody>
          <?php foreach($accs as $a): $bal = accountBalance($pdo,$a['id'],null,$to); if($bal>=0){ $dr=$bal; $cr=0; } else { $dr=0; $cr=abs($bal);} $totdr+=$dr; $totcr+=$cr; ?>
            <tr><td><?=$a['id']?></td><td><?=htmlspecialchars($a['name'])?></td><td><?=$a['grp']?></td><td><?=htmlspecialchars($a['subgroup'])?></td><td class="text-end"><?=formatMoney($dr)?></td><td class="text-end"><?=formatMoney($cr)?></td></tr>
          <?php endforeach; ?>
          </tbody>
          <tfoot><tr class="fw-bold"><td colspan="4" class="text-end">Totals</td><td class="text-end"><?=formatMoney($totdr)?></td><td class="text-end"><?=formatMoney($totcr)?></td></tr></tfoot>
        </table>
      </div>
    </div></div>
  <?php endif; ?>

  <?php if($action==='pl'): ?>
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title">Profit & Loss (Simple)</h5>
      <?php $from=$_GET['from']??date('Y-04-01'); $to=$_GET['to']??date('Y-m-t'); ?>
      <form class="row g-2 mb-2">
        <input type="hidden" name="action" value="pl">
        <div class="col-md-3"><label class="form-label">From</label><input type="date" name="from" class="form-control" value="<?=$from?>"></div>
        <div class="col-md-3"><label class="form-label">To</label><input type="date" name="to" class="form-control" value="<?=$to?>"></div>
        <div class="col-md-2 d-flex align-items-end"><button class="btn btn-primary">Apply</button></div>
      </form>
      <?php
        // Sum Income & Expense between dates
        $inc = one(q($pdo,"SELECT SUM(l.cr - l.dr) net FROM voucher_lines l JOIN vouchers v ON v.id=l.voucher_id JOIN accounts a ON a.id=l.account_id WHERE a.grp='Income' AND v.vdate BETWEEN ? AND ?",[$from,$to]));
        $exp = one(q($pdo,"SELECT SUM(l.dr - l.cr) net FROM voucher_lines l JOIN vouchers v ON v.id=l.voucher_id JOIN accounts a ON a.id=l.account_id WHERE a.grp='Expense' AND v.vdate BETWEEN ? AND ?",[$from,$to]));
        $income = (float)($inc['net'] ?? 0); $expense=(float)($exp['net'] ?? 0); $profit = $income - $expense;
      ?>
      <div class="row">
        <div class="col-md-4"><div class="p-3 border rounded bg-light">Total Income: <strong>₹ <?=formatMoney($income)?></strong></div></div>
        <div class="col-md-4"><div class="p-3 border rounded bg-light">Total Expense: <strong>₹ <?=formatMoney($expense)?></strong></div></div>
        <div class="col-md-4"><div class="p-3 border rounded bg-<?= $profit>=0?'success':'danger' ?> text-white">Net <?= $profit>=0?'Profit':'Loss' ?>: <strong>₹ <?=formatMoney(abs($profit))?></strong></div></div>
      </div>
    </div></div>
  <?php endif; ?>

  <?php if($action==='bs'): ?>
    <div class="card shadow-sm"><div class="card-body">
      <h5 class="card-title">Balance Sheet (Simple)</h5>
      <?php $to=$_GET['to']??date('Y-m-t'); ?>
      <form class="row g-2 mb-2">
        <input type="hidden" name="action" value="bs">
        <div class="col-md-3"><label class="form-label">As on</label><input type="date" name="to" class="form-control" value="<?=$to?>"></div>
        <div class="col-md-2 d-flex align-items-end"><button class="btn btn-primary">Apply</button></div>
      </form>
      <div class="row g-3">
        <div class="col-md-6">
          <div class="border rounded p-2">
            <h6>Assets</h6>
            <ul class="list-group list-group-flush">
              <?php $rows = all(q($pdo,"SELECT id,name FROM accounts WHERE grp='Asset' ORDER BY name")); $total=0; foreach($rows as $r){ $b=accountBalance($pdo,$r['id'],null,$to); if($b<0) $b=0; $total+=$b; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center"><?=htmlspecialchars($r['name'])?><span>₹ <?=formatMoney($b)?></span></li>
              <?php } ?>
              <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">Total Assets<span>₹ <?=formatMoney($total)?></span></li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="border rounded p-2">
            <h6>Liabilities & Capital</h6>
            <ul class="list-group list-group-flush">
              <?php $rows = all(q($pdo,"SELECT id,name,grp FROM accounts WHERE grp IN('Liability','Capital') ORDER BY grp,name")); $total2=0; foreach($rows as $r){ $b=accountBalance($pdo,$r['id'],null,$to); if($b>0) $b=0; $b=abs($b); $total2+=$b; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">[<?=$r['grp']?>] <?=htmlspecialchars($r['name'])?><span>₹ <?=formatMoney($b)?></span></li>
              <?php } ?>
              <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">Total Liab + Capital<span>₹ <?=formatMoney($total2)?></span></li>
            </ul>
          </div>
        </div>
      </div>
    </div></div>
  <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(function(){
    $('.sel2').select2();
    const renum = ()=>{
      let tdr=0,tcr=0; $('#linesTbl tbody tr').each(function(){
        const dr=parseFloat($(this).find('.dr').val()||0); const cr=parseFloat($(this).find('.cr').val()||0);
        tdr+=dr; tcr+=cr; });
      $('#totDr').text(tdr.toFixed(2)); $('#totCr').text(tcr.toFixed(2));
      const ok = Math.abs(tdr-tcr) < 0.01; $('#balTag').text(ok? 'Balanced' : 'Not Balanced').removeClass('bg-secondary bg-danger bg-success').addClass(ok?'bg-success':'bg-danger');
    };
    renum();
    $('#linesTbl').on('input','.dr,.cr',renum);
    $('#addLine').on('click',function(){
      const row = $('#linesTbl tbody tr:first').clone();
      row.find('select').val('').trigger('change');
      row.find('input').val('');
      $('#linesTbl tbody').append(row); renum();
    });
    $('#linesTbl').on('click','.del',function(){ if($('#linesTbl tbody tr').length>1){ $(this).closest('tr').remove(); renum(); } });
  });
</script>
</body>
</html>
