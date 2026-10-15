<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['id_rol'] != 1) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Proyecto La Biblioteca</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome para Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-outer: #0b1317;
            --bg-container: #101c23;
            --bg-card: #152731;
            --bg-sidebar: #122028;
            --text-light: #e2e8f0;
            --text-muted: #829ab1;
            --accent-yellow: #fcd34d;
            --accent-green: #48bb78;
            --accent-purple: #9f7aea;
            --accent-blue: #4299e1;
        }

        body {
            background-color: var(--bg-outer);
            color: var(--text-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-wrapper {
            background-color: var(--bg-container);
            border-radius: 24px;
            width: 100%;
            max-width: 1350px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
            display: flex;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.04);
            position: relative;
        }

        .sidebar {
            width: 240px;
            background-color: var(--bg-sidebar);
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.04);
            padding: 25px 20px;
            justify-content: flex-start;
        }

        .sidebar-top .logo-area {
            font-size: 1.8rem;
            color: #ffffff;
            margin-bottom: 35px;
            padding-left: 5px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .nav-item a {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-muted);
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-item a:hover, .nav-item a.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.06);
        }

        .nav-item a i {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        .main-content {
            flex: 1;
            padding: 30px 40px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            padding-bottom: 20px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .topbar-logout {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 0.95rem;
            padding-left: 25px;
            border-left: 1px solid rgba(255, 255, 255, 0.15);
            transition: color 0.2s;
        }

        .topbar-logout:hover {
            color: #fc8181;
        }

        .welcome-banner {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .admin-avatar {
            width: 60px;
            height: 60px;
            background-color: #243b53;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #b794f4;
            border: 2px solid rgba(183, 148, 244, 0.3);
        }

        .welcome-text h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 0 4px 0;
            color: #ffffff;
        }

        .welcome-text p {
            margin: 0;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .stat-card {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 18px 20px;
            border: 1px solid rgba(255, 255, 255, 0.04);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-muted);
            font-size: 0.82rem;
        }

        .stat-header i {
            font-size: 1.1rem;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--accent-yellow);
            margin-top: 8px;
        }

        .lower-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .content-card {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 22px 25px;
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

        .admin-books-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .admin-books-title {
            font-size: 1.15rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .btn-agregar {
            background-color: var(--accent-blue);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.82rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .btn-agregar:hover {
            background-color: #3182ce;
            color: #ffffff;
        }

        .filter-row {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-input-admin {
            flex: 1;
            background-color: #0b1317;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 7px 14px;
            color: #ffffff;
            font-size: 0.85rem;
            outline: none;
        }

        .filter-select {
            background-color: #0b1317;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 7px 12px;
            color: var(--text-muted);
            font-size: 0.85rem;
            outline: none;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .custom-table th {
            color: var(--text-muted);
            font-weight: 600;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            text-align: left;
        }

        .custom-table td {
            padding: 12px 0;
            vertical-align: middle;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            color: var(--text-light);
        }

        .table-book-img {
            width: 35px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .badge-tag {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-green { background-color: rgba(72, 187, 120, 0.2); color: #68d391; }
        .badge-purple { background-color: rgba(159, 122, 234, 0.2); color: #b794f4; }
        .badge-status { background-color: rgba(72, 187, 120, 0.15); color: #48bb78; }

        .action-icon {
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-right: 10px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .action-icon:hover { color: #ffffff; }
        .action-icon.delete:hover { color: #fc8181; }

        .table-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 0.78rem;
            color: var(--text-muted);
        }

        .pagination-controls {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .pagination-controls a {
            color: var(--text-muted);
            text-decoration: none;
            padding: 2px 8px;
            border-radius: 4px;
        }

        .pagination-controls a.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .right-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .activity-card {
            height: 180px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .activity-header {
            font-size: 1.05rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quick-access-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .quick-btn {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 15px 10px;
            text-align: center;
            text-decoration: none;
            color: var(--text-light);
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s;
        }

        .quick-btn:hover {
            background-color: rgba(255, 255, 255, 0.07);
            color: #ffffff;
        }

        .quick-btn i {
            font-size: 1.2rem;
            color: var(--text-muted);
        }

        @media (max-width: 1100px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .lower-layout { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="dashboard-wrapper">

        <div class="sidebar">
            <div class="sidebar-top">
                <div class="logo-area">
                    <i class="fa-regular fa-book-open"></i>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="admin.php" class="active"><i class="fa-solid fa-house"></i> Inicio</a></li>
                    <li class="nav-item"><a href="#"><i class="fa-solid fa-book"></i> Libros</a></li>
                    <li class="nav-item"><a href="#"><i class="fa-solid fa-tags"></i> Categorias</a></li>
                    <li class="nav-item"><a href="#"><i class="fa-solid fa-users"></i> Usuarios</a></li>
                    <li class="nav-item"><a href="#"><i class="fa-solid fa-chart-pie"></i> Reportes</a></li>
                    <li class="nav-item"><a href="#"><i class="fa-solid fa-gear"></i> Configuracion</a></li>
                </ul>
            </div>
        </div>

        <div class="main-content">

            <div class="topbar">
                <div class="topbar-user">
                    <i class="fa-regular fa-user"></i>
                    <span>Administrador</span>
                </div>
                <div>
                    <a href="logout.php" class="topbar-logout">
                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesion
                    </a>
                </div>
            </div>

            <div class="welcome-banner">
                <div class="admin-avatar">
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="welcome-text">
                    <h1>Hola, Administrador</h1>
                    <p>Aqui tienes un resumen de la actividad de la biblioteca</p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span>Total de Libros</span>
                        <i class="fa-regular fa-book"></i>
                    </div>
                    <div class="stat-value">230</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span>Usuarios Registrados</span>
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="stat-value">57</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span>Categorias</span>
                        <i class="fa-solid fa-tag"></i>
                    </div>
                    <div class="stat-value">8</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <span>Prestamos</span>
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                    <div class="stat-value">5</div>
                </div>
            </div>

            <div class="lower-layout">
                
                
                <div class="content-card">
                    <div class="admin-books-header">
                        <h3 class="admin-books-title">
                            <i class="fa-regular fa-book-open"></i> Administracion de Libros
                        </h3>
                        <a href="#" class="btn-agregar">
                            <i class="fa-solid fa-plus"></i> Agregar Libro
                        </a>
                    </div>

                    
                    <div class="filter-row">
                        <input type="text" class="search-input-admin" placeholder="Buscar por titulo o autor...">
                        <select class="filter-select">
                            <option>Categorias</option>
                        </select>
                        <select class="filter-select">
                            <option>Estado</option>
                        </select>
                    </div>

                    
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Portada</th>
                           <th>Titulo</th>
                                <th>Autor</th>
                                <th>Categoria</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><img src="assets/Portadas/Dracula.jpg" class="table-book-img" alt="Drácula" onerror="this.src='https://via.placeholder.com/35x50/152731/ffffff?text=Libro'"></td>
                                <td class="fw-bold">Dracula</td>
                                <td></td>
                                <td><span class="badge-tag badge-green">Disponible</span></td>
                                <td><span class="badge-tag badge-status">Disponible</span></td>
                                <td>
                                    <a href="#" class="action-icon"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="#" class="action-icon delete"><i class="fa-regular fa-trash-can"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="assets/Portadas/El Principito.jpg" class="table-book-img" alt="El Principito" onerror="this.src='https://via.placeholder.com/35x50/152731/ffffff?text=Libro'"></td>
                                <td class="fw-bold">El Principito</td>
                                <td>Saint de Exupery</td>
                                <td><span class="badge-tag badge-green">Clasico</span></td>
                                <td><span class="badge-tag badge-status">Disponible</span></td>
                                <td>
                                    <a href="#" class="action-icon"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="#" class="action-icon delete"><i class="fa-regular fa-trash-can"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="assets/Portadas/Juego de Tronos.jpg" class="table-book-img" alt="Juego de Tronos" onerror="this.src='https://via.placeholder.com/35x50/152731/ffffff?text=Libro'"></td>
                                <td class="fw-bold">Juego de Tronos</td>
                                <td>Georg R.R. Martin</td>
                                <td></td>
                                <td><span class="badge-tag badge-status">Disponible</span></td>
                                <td>
                                    <a href="#" class="action-icon"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="#" class="action-icon delete"><i class="fa-regular fa-trash-can"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="assets/Portadas/Nosotros en la Luna.jpg" class="table-book-img" alt="Nosotros en la Luna" onerror="this.src='https://via.placeholder.com/35x50/152731/ffffff?text=Libro'"></td>
                                <td class="fw-bold">Nosotros en la luna</td>
                                <td>Alice Kellen</td>
                                <td><span class="badge-tag badge-purple">Juvenil</span></td>
                                <td><span class="badge-tag badge-status">Disponible</span></td>
                                <td>
                                    <a href="#" class="action-icon"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <a href="#" class="action-icon delete"><i class="fa-regular fa-trash-can"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="table-footer">
                        <span>Mostrando 1-5 de 230 libros</span>
                        <div class="pagination-controls">
                            <a href="#">&lt;</a>
                            <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">&gt;</a>
                        </div>
                    </div>
                </div>

                <div class="right-column">

                    <div class="content-card activity-card">
                        <div class="activity-header">
                            <i class="fa-regular fa-clock"></i> Actividad Reciente
                        </div>
                        <div class="text-muted" style="font-size: 0.82rem;">
                            Sin registros de actividad recientes en el sistema.
                        </div>
                        <div></div>
                    </div>

                    <div class="content-card">
                        <div class="activity-header mb-3">
                            <i class="fa-solid fa-bolt"></i> Accesos rapidos
                        </div>
                        <div class="quick-access-grid">
                            <a href="#" class="quick-btn">
                                <i class="fa-solid fa-plus-circle"></i>
                                Agregar Libro
                            </a>
                            <a href="#" class="quick-btn">
                                <i class="fa-regular fa-file-lines"></i>
                                Ver Reportes
                            </a>
                            <a href="#" class="quick-btn">
                                <i class="fa-solid fa-users"></i>
                                Ver Usuarios
                            </a>
                            <a href="#" class="quick-btn">
                                <i class="fa-solid fa-tags"></i>
                                Categorias
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>