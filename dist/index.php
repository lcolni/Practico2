<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto La Biblioteca</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #121f26;
            --bg-card: #1b2e38;
            --bg-sidebar: #172630;
            --text-main: #e1e7ec;
            --text-muted: #8b9da2;
            --accent-yellow: #f1c40f;
            --accent-orange: #f39c12;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        .sidebar-left {
            width: 70px;
            background-color: var(--bg-sidebar);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .sidebar-left .nav-icon {
            color: #7f8c8d;
            font-size: 1.2rem;
            margin: 18px 0;
            text-decoration: none;
            transition: color 0.2s;
        }

        .sidebar-left .nav-icon:hover, .sidebar-left .nav-icon.active {
            color: var(--text-main);
        }

        .main-wrapper {
            margin-left: 70px;
            padding: 20px 30px;
        }

        .top-navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .brand-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-main);
        }

        .search-box {
            background-color: var(--bg-card);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 6px 15px;
            width: 320px;
            display: flex;
            align-items: center;
        }

        .search-box input {
            background: transparent;
            border: none;
            color: var(--text-main);
            outline: none;
            font-size: 0.9rem;
            width: 100%;
            margin-left: 8px;
        }

        .book-card {
            background-color: transparent;
            border: none;
            transition: transform 0.2s;
        }

        .book-card:hover {
            transform: translateY(-5px);
        }

        .book-img {
            border-radius: 8px;
            width: 100%;
            height: 200px;
            object-fit: cover;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .book-title {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 8px;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .book-author {
            font-size: 0.75rem;
            color: #7f8c8d;
            margin-bottom: 2px;
        }

        .book-price {
            font-size: 0.8rem;
            font-weight: bold;
            color: var(--accent-yellow);
        }

        .cat-card {
            background-color: var(--bg-card);
            border-radius: 10px;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .cat-card.active-cat {
            background-color: var(--accent-orange);
            color: #121f26;
        }

        .cat-card.active-cat .text-muted-custom {
            color: #2c3e50 !important;
        }

        .text-muted-custom {
            color: #7f8c8d;
            font-size: 0.75rem;
        }

        .author-card {
            background-color: var(--bg-card);
            border-radius: 10px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .author-img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .rating-stars {
            color: var(--accent-yellow);
            font-size: 0.65rem;
        }
    </style>
</head>
<body>

    <div class="sidebar-left">
        <a href="index.php" class="nav-icon active"><i class="fa-solid fa-book-open"></i></a>
        <a href="#libros" class="nav-icon"><i class="fa-solid fa-book"></i></a>
        <a href="#carrito" class="nav-icon"><i class="fa-solid fa-cart-shopping"></i></a>
        <a href="#autores" class="nav-icon"><i class="fa-solid fa-pen-nib"></i></a>
        <a href="#contacto" class="nav-icon"><i class="fa-solid fa-phone"></i></a>
        <a href="#config" class="nav-icon"><i class="fa-solid fa-gear"></i></a>
        
        <div class="mt-auto mb-4">
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="logout.php" class="nav-icon text-danger" title="Cerrar Sesión"><i class="fa-solid fa-right-from-bracket"></i></a>
            <?php else: ?>
                <a href="login.php" class="nav-icon text-success" title="Iniciar Sesión"><i class="fa-solid fa-right-to-bracket"></i></a>
            <?php endif; ?>
        </div>
    </div>

    <div class="main-wrapper">
        
        <div class="top-navbar">
            <div class="d-flex align-items-center gap-4">
                <span class="brand-title">Proyecto La Biblioteca</span>
                <a href="index.php" class="text-decoration-none text-light fw-bold fs-6">Librería</a>
                <a href="#libros" class="text-decoration-none text-secondary fs-6">Libros</a>
                <a href="#autores" class="text-decoration-none text-secondary fs-6">Autores</a>
            </div>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                <input type="text" placeholder="Buscar libro, autor o categoría...">
            </div>

            <div class="d-flex align-items-center gap-3">
                <i class="fa-regular fa-bell text-secondary fs-5" style="cursor:pointer;"></i>
                <i class="fa-regular fa-envelope text-secondary fs-5" style="cursor:pointer;"></i>
                
                <div class="d-flex align-items-center gap-2 ms-2">
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <span class="fs-6 fw-bold me-1"><?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
                        <?php if ($_SESSION['id_rol'] == 1): ?>
                            <a href="admin.php" class="btn btn-warning btn-sm py-0 px-2 fs-7">Admin</a>
                        <?php endif; ?>
                        <a href="logout.php" class="btn btn-outline-danger btn-sm py-0 px-2 fs-7">Salir</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary btn-sm px-3">Ingresar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row g-4">
            
            <div class="col-lg-8">
            
                <div class="mb-4">
                    <h2 class="section-title">Sagas Completas</h2>
                    <div class="row row-cols-2 row-cols-md-5 g-3">
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Juego de Tronos.jpg" class="book-img" alt="Juego de Tronos">
                                <div class="book-title">Juego de Tronos</div>
                                <div class="book-author">George R.R. Martin</div>
                                <div class="book-price">$ 1.500</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Choque de Reyes.jpg" class="book-img" alt="Choque de Reyes">
                                <div class="book-title">Choque de Reyes</div>
                                <div class="book-author">George R.R. Martin</div>
                                <div class="book-price">$ 1.450</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Tormenta de Espadas.jpg" class="book-img" alt="Tormenta de Espadas">
                                <div class="book-title">Tormenta de Espadas</div>
                                <div class="book-author">George R.R. Martin</div>
                                <div class="book-price">$ 1.450</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Festin de Cuervos.jpg" class="book-img" alt="Festín de Cuervos">
                                <div class="book-title">Festín de Cuervos</div>
                                <div class="book-author">George R.R. Martin</div>
                                <div class="book-price">$ 1.450</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Danza de Dragones.jpg" class="book-img" alt="Danza de Dragones">
                                <div class="book-title">Danza de Dragones</div>
                                <div class="book-author">George R.R. Martin</div>
                                <div class="book-price">$ 1.550</div>
                            </div>
                        </div>
                    </div>
                </div>

               
                <div class="mb-4">
                    <h2 class="section-title">Categorías</h2>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="cat-card">
                                <div>
                                    <div class="fw-bold">Autoayuda</div>
                                    <div class="text-muted-custom">Libros Disponibles</div>
                                </div>
                                <span class="fs-5 fw-bold">1.2k</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cat-card">
                                <div>
                                    <div class="fw-bold">Clásicos</div>
                                    <div class="text-muted-custom">Libros Disponibles</div>
                                </div>
                                <span class="fs-5 fw-bold">1.8K</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cat-card">
                                <div>
                                    <div class="fw-bold">Economía</div>
                                    <div class="text-muted-custom">Libros Disponibles</div>
                                </div>
                                <span class="fs-5 fw-bold">230</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cat-card">
                                <div>
                                    <div class="fw-bold">Estudio</div>
                                    <div class="text-muted-custom">Libros Disponibles</div>
                                </div>
                                <span class="fs-5 fw-bold">80</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cat-card active-cat">
                                <div>
                                    <div class="fw-bold">Cocina</div>
                                    <div class="text-muted-custom">Libros Disponibles</div>
                                </div>
                                <span class="fs-5 fw-bold">180</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cat-card">
                                <div>
                                    <div class="fw-bold">Fantasía</div>
                                    <div class="text-muted-custom">Libros Disponibles</div>
                                </div>
                                <span class="fs-5 fw-bold">1.9K</span>
                            </div>
                        </div>
                    </div>
                </div>

              
                <div>
                    <h2 class="section-title">Nuevos Libros</h2>
                    <div class="row row-cols-2 row-cols-md-6 g-2">
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/El Ladron del Rayo.jpg" class="book-img" style="height:170px;" alt="El Ladrón del Rayo">
                                <div class="book-title">El ladrón del Rayo</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/El imperio Final.jpg" class="book-img" style="height:170px;" alt="El Imperio Final">
                                <div class="book-title">El Imperio Final</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Matar a un ruiseñor.jpg" class="book-img" style="height:170px;" alt="Matar a un Ruiseñor">
                                <div class="book-title">Matar a un Ruiseñor</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Una habitación propia.jpg" class="book-img" style="height:170px;" alt="Una habitación propia">
                                <div class="book-title">Una habitación Propia</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/El mundo de Sofía.jpg" class="book-img" style="height:170px;" alt="El Mundo de Sofía">
                                <div class="book-title">El Mundo de Sofía</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="book-card">
                                <img src="assets/Portadas/Tan Poca Vida.jpg" class="book-img" style="height:170px;" alt="Tan Poca Vida">
                                <div class="book-title">Tan Poca Vida</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

           
            <div class="col-lg-4">
                
                
                <div class="mb-4">
                    <h2 class="section-title">Libros Populares</h2>
                    <div class="row row-cols-4 g-2">
                        <div class="col">
                            <img src="assets/Portadas/Boulevard.jpg" class="book-img" style="height:115px;" alt="Boulevard">
                            <div class="book-title" style="font-size:0.75rem;">Boulevard</div>
                            <div class="book-author" style="font-size:0.65rem;">Flor M. Salvador</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="col">
                            <img src="assets/Portadas/El príncipe.jpg" class="book-img" style="height:115px;" alt="El Príncipe">
                            <div class="book-title" style="font-size:0.75rem;">El Príncipe</div>
                            <div class="book-author" style="font-size:0.65rem;">Nicolás Maquiavelo</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="col">
                            <img src="assets/Portadas/La biblioteca de la medianoche.jpg" class="book-img" style="height:115px;" alt="La Biblioteca de la Medianoche">
                            <div class="book-title" style="font-size:0.75rem;">La biblioteca de...</div>
                            <div class="book-author" style="font-size:0.65rem;">Matt Haig</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="col">
                            <img src="assets/Portadas/Cumbres Borrascosas.jpg" class="book-img" style="height:115px;" alt="Cumbres Borrascosas">
                            <div class="book-title" style="font-size:0.75rem;">Cumbres Borras...</div>
                            <div class="book-author" style="font-size:0.65rem;">Emily Brontë</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="col mt-2">
                            <img src="assets/Portadas/El Principito.jpg" class="book-img" style="height:115px;" alt="El Principito">
                            <div class="book-title" style="font-size:0.75rem;">El Principito</div>
                            <div class="book-author" style="font-size:0.65rem;">Antoine de Saint-Exupéry</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="col mt-2">
                            <img src="assets/Portadas/Dracula.jpg" class="book-img" style="height:115px;" alt="Drácula">
                            <div class="book-title" style="font-size:0.75rem;">Drácula</div>
                            <div class="book-author" style="font-size:0.65rem;">Bram Stoker</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="col mt-2">
                            <img src="assets/Portadas/Nosotros en la Luna.jpg" class="book-img" style="height:115px;" alt="Nosotros en la Luna">
                            <div class="book-title" style="font-size:0.75rem;">Nosotros en la...</div>
                            <div class="book-author" style="font-size:0.65rem;">Alice Kellen</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <div class="col mt-2">
                            <img src="assets/Portadas/La Odisea.jpg" class="book-img" style="height:115px;" alt="La Odisea">
                            <div class="book-title" style="font-size:0.75rem;">La Odisea</div>
                            <div class="book-author" style="font-size:0.65rem;">Homero</div>
                            <div class="rating-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                    </div>
                </div>

                
                <div>
                    <h2 class="section-title">Autores</h2>
                    
                    <div class="author-card">
                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/Autores/Brandon Sanderson.jpg" class="author-img" alt="Brandon Sanderson">
                            <div>
                                <div class="fw-bold fs-7">Brandon Sanderson</div>
                                <div class="text-muted-custom">Escribe y Publica</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-7">57</div>
                            <div class="text-muted-custom">Libros</div>
                        </div>
                    </div>

                    <div class="author-card">
                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/Autores/J.KRowling.jpg" class="author-img" alt="J.K. Rowling">
                            <div>
                                <div class="fw-bold fs-7">J.K. Rowling</div>
                                <div class="text-muted-custom">Escribe y Publica</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-7">22</div>
                            <div class="text-muted-custom">Libros</div>
                        </div>
                    </div>

                    <div class="author-card">
                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/Autores/Fiodor Dotoievski.jpg" class="author-img" alt="Fiódor Dostoyevski">
                            <div>
                                <div class="fw-bold fs-7">Fiódor Dostoyevski</div>
                                <div class="text-muted-custom">Escritor</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-7">12</div>
                            <div class="text-muted-custom">Libros</div>
                        </div>
                    </div>

                    <div class="author-card">
                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/Autores/Francisco Quevedo.jpg" class="author-img" alt="Francisco Quevedo">
                            <div>
                                <div class="fw-bold fs-7">Francisco Quevedo</div>
                                <div class="text-muted-custom">Escritor</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-7">84</div>
                            <div class="text-muted-custom">Libros</div>
                        </div>
                    </div>

                    <div class="author-card">
                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/Autores/Isabel Allende.jpg" class="author-img" alt="Isabel Allende">
                            <div>
                                <div class="fw-bold fs-7">Isabel Allende</div>
                                <div class="text-muted-custom">Escritora</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-7">28</div>
                            <div class="text-muted-custom">Libros</div>
                        </div>
                    </div>

                    <div class="author-card">
                        <div class="d-flex align-items-center gap-3">
                            <img src="assets/Autores/Robert Jordan.jpg" class="author-img" alt="Robert Jordan">
                            <div>
                                <div class="fw-bold fs-7">Robert Jordan</div>
                                <div class="text-muted-custom">Escribe y Publica</div>
                            </div>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold fs-7">10</div>
                            <div class="text-muted-custom">Libros</div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>