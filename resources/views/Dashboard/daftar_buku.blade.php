<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Buku</title>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: sans-serif;
    }

    body {
      background-color: #e0f0ff;
      padding: 20px;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      background-color: #000080;
      color: white;
      border-radius: 10px;
      padding: 20px;
      display: flex;
      flex-direction: column;
      min-height: 90vh;
    }

    .header {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: white;
    }

    .search-bar {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
      margin-bottom: 20px;
    }

    .table-container {
      background-color: #2e2eec;
      border-radius: 8px;
      padding: 15px;
      overflow-x: auto;
      flex-grow: 1;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th {
      text-align: left;
      padding: 10px;
      font-size: 14px;
      color: white;
    }

    td {
      padding: 10px;
      font-size: 14px;
      color: white;
    }

    .btn-kembali {
      background-color: #1e90ff;
      color: white;
      padding: 10px 18px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
      align-self: start;
    }

    .bottom-nav {
      display: flex;
      justify-content: center;
      gap: 40px;
      background-color: #dcdcdc;
      padding: 14px;
      border-radius: 0 0 10px 10px;
      margin-top: 30px;
    }

    .bottom-nav a {
      color: black;
      font-size: 24px;
      text-decoration: none;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .header {
        font-size: 20px;
      }

      .btn-kembali {
        font-size: 14px;
        padding: 8px 14px;
      }

      th, td {
        font-size: 13px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">Daftar Buku</div>

    <input type="text" class="search-bar" placeholder="Cari ..." />

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>id_buku</th>
            <th>judul</th>
            <th>penulis</th>
            <th>Kategori</th>
            <th>statusBuku</th>
            <th>penerbit</th>
            <th>tahunTerbit</th>
          </tr>
        </thead>
        <tbody>
          <!-- Contoh baris -->
          <tr>
            <td>001</td>
            <td>Bumi</td>
            <td>Tere Liye</td>
            <td>Fiksi</td>
            <td>Tersedia</td>
            <td>Gramedia</td>
            <td>2021</td>
          </tr>
        </tbody>
      </table>
    </div>

    <button class="btn-kembali">Kembali</button>

    <div class="bottom-nav">
      <a href="#"><i class="fas fa-home"></i></a>
      <a href="#"><i class="fas fa-bell"></i></a>
      <a href="#"><i class="fas fa-user"></i></a>
    </div>
  </div>
</body>
</html>
