<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students Records</title>

  <style>
    :root {
      --card-bg: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(107,91,154,0.15));
      --primary: #6B5B9A;
      --primary-hover: #5A4C7A;
      --text: #333333;
      --radius: 12px;
      font-family: 'Roboto', sans-serif;
    }

    body {
      margin: 0;
      background: transparent; 
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 32px;
      color: var(--text);
    }

    .container {
      width: 100%;
      max-width: 960px;
      background: var(--card-bg);
      backdrop-filter: blur(8px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
      border-radius: var(--radius);
      overflow: hidden;
    }

    .header {
      background: rgba(107, 91, 154, 0.85);
      padding: 20px;
      border-radius: var(--radius) var(--radius) 0 0;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
    }

    h2 {
      margin: 0;
      font-size: 2rem;
      font-weight: 700;
    }

    .btn {
      padding: 10px 16px;
      border-radius: var(--radius);
      text-decoration: none;
      font-weight: 500;
      font-size: 1rem;
      background: #fff;
      color: var(--primary);
      transition: all 0.2s;
    }

    .btn:hover {
      background: var(--primary);
      color: #fff;
      transform: translateY(-2px);
    }

    .search-box {
      flex: 1;
      display: flex;
      justify-content: flex-end;
    }

    .search-box input {
      padding: 8px 14px;
      border-radius: var(--radius);
      border: none;
      outline: none;
      font-size: 1rem;
      width: 250px;
      max-width: 100%;
      background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(107,91,154,0.1));
      color: var(--text);
    }

    .card {
      background: var(--card-bg);
      backdrop-filter: blur(6px);
      border-radius: 0 0 var(--radius) var(--radius);
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px 16px;
      text-align: left;
      font-size: 0.95rem;
    }

    th {
      background: rgba(234, 234, 234, 0.8);
      font-weight: 600;
      color: var(--text);
      border-bottom: 2px solid var(--primary);
    }

    tr {
      transition: background-color 0.2s;
    }

    tr:nth-child(even) {
      background: rgba(249, 249, 249, 0.6);
    }

    tr:hover {
      background: rgba(225, 225, 225, 0.7);
    }

    .actions a {
      margin-right: 10px;
      text-decoration: none;
      color: var(--primary);
      font-weight: 500;
      transition: color 0.2s;
    }

    .actions a:hover {
      color: var(--primary-hover);
    }

    /* Pagination styles */
    .pagination-container {
      padding: 16px;
      border-top: 1px solid #ddd;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
    }

    /* Remove bullets and display pagination horizontally */
.pagination-links ul {
  list-style: none; /* Remove bullets */
  padding: 0;
  margin: 0;
  display: flex;
  gap: 8px; /* Space between buttons */
  justify-content: center;
}

.pagination-links li {
  display: inline-block;
}

.pagination-links a,
.pagination-links li span {
  display: inline-block;
  padding: 8px 14px;
  border-radius: 12px;
  background: #fff;
  color: var(--primary);
  font-weight: 500;
  text-decoration: none;
  transition: all 0.2s;
}

.pagination-links a:hover,
.pagination-links .active {
  background: var(--primary);
  color: #fff;
}

  </style>
</head>
<body>

  <div class="container">
    <div class="header">
      <h2>Students Record</h2>
      <div class="search-box">
        <form class="search-form" method="get" action="/students/get_all">
  
  <input 
    type="text" 
    name="search" 
    value="<?= $search ?? '' ?>" 
    placeholder="Search Here....">
    
  <button type="submit">Search</button>
</form>

      </div>
      <a class="btn" href="<?= base_url().'students/add' ?>">ADD HERE</a>
    </div>
    <div class="card">
      <table id="studentsTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($records)): ?>
            <?php foreach($records as $s): ?>
            <tr>
              <td><?= $s['id'] ?></td>
              <td><?= $s['fname'] ?></td>
              <td><?= $s['lname'] ?></td>
              <td><?= $s['email'] ?></td>
              <td class="actions">
                <a href="<?= base_url().'students/update/'.$s['id'] ?>">EDIT</a>
                <a href="<?= base_url().'students/delete/'.$s['id'] ?>" onclick="return confirm('Delete student?')">DELETE</a>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>

      <!-- Server-side Pagination -->
      <?php if (isset($pagination_data)): ?>
<div class="pagination-container" style="flex-direction: column; align-items: center; gap: 12px; padding: 20px;">
  <!-- Pagination Links -->
  <div class="pagination-links">
    <?= $pagination_links; ?>
  </div>

  <!-- Info Text -->
  <div style="font-size: 0.9rem; color: #555;">
    <?= $pagination_data['info']; ?>
  </div>

  <!-- Items per Page Selector -->
  <div style="display: flex; align-items: center; gap: 8px;">
    <label for="itemsPerPage" style="font-size: 0.9rem; color: #555;">Items per page:</label>
    <select id="itemsPerPage" style="padding: 6px 12px; border-radius: 8px; border: 1px solid #ccc;">
      <option value="10" <?= (isset($_GET['per_page']) && $_GET['per_page'] == 10) ? 'selected' : ''; ?>>10</option>
      <option value="25" <?= (isset($_GET['per_page']) && $_GET['per_page'] == 25) ? 'selected' : ''; ?>>25</option>
      <option value="50" <?= (isset($_GET['per_page']) && $_GET['per_page'] == 50) ? 'selected' : ''; ?>>50</option>
      <option value="100" <?= (isset($_GET['per_page']) && $_GET['per_page'] == 100) ? 'selected' : ''; ?>>100</option>
    </select>
  </div>
</div>
<?php endif; ?>

    </div>
  </div>

  <script>
    // Items per page (server-side trigger)
    document.addEventListener('DOMContentLoaded', function() {
      const itemsPerPageSelect = document.getElementById('itemsPerPage');
      if (itemsPerPageSelect) {
        itemsPerPageSelect.addEventListener('change', function() {
          const selectedValue = this.value;
          const currentUrl = new URL(window.location.href);
          currentUrl.searchParams.set('per_page', selectedValue);
          if (currentUrl.pathname.includes('/index/')) {
              currentUrl.pathname = currentUrl.pathname.replace(/\/index\/\d+/, '/index/1');
          }
          window.location.href = currentUrl.toString();
        });
      }
    });
  </script>

</body>
</html>
