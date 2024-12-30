<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TATIB Dashboard</title>
    <link rel="stylesheet" href="Sanksi.css">
</head>
<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <a class="navbar-brand" href="#"></a>
        <img src="../SAKSI/img/jti.png">
        <p>Sistem Informasi Tata Tertib</p>
        <span class="navbar-toggler-icon"></span>
    </nav>

    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo"></div>
            <div class="user-info">

                <br>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header1">
                <h1>Sanksi</h1>
            </div>
            <div class="content">
    <div class="table-header">
        <h2>Form Bukti Sanksi</h2>
        <form>
            <div class="form-group">
                <label for="sanksi">Sanksi Yang Anda Terima</label>
                <select id="sanksi" name="sanksi">
                    <option>T1. Diberi Surat Peringatan 2</option>
                    <option>T2. Skorsing 3 Minggu</option>
                    <option>T3. Diberi Surat Peringatan 1</option>
                    <option>T4. Skorsing 1 Minggu</option>
                    <option>T5. Teguran Lisan/Peringatan Tertulis</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bukti">Upload Bukti</label>
                <input type="file" id="bukti" name="bukti" accept="image/*">
            </div>
            <div class="form-actions">
                <button type="button" class="cancel">Cancel</button>
                <button type="submit" class="save">Save Changes</button>
            </div>
        </form>
    </div>
</div>
              
                
        </div>
    </div>
</body>