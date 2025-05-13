<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú - MoonCafe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .menu-item-details {
            flex-grow: 1;
        }
        .order-controls {
            display: flex;
            align-items: center;
        }
        .quantity-input {
            width: 60px;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5" id="app-menu">
        <header class="text-center mb-4">
            <h1>Menú de MoonCafe</h1>
            <nav class="mt-2">
                <a href="index.php" class="btn btn-link">Inicio</a>
                <a href="menu.php" class="btn btn-link">Menú</a>
                <a href="crear_cuenta.html" class="btn btn-link">Crear Cuenta</a>
                <a href="novedades.html" class="btn btn-link">Novedades</a>
                <a href="contacto.html" class="btn btn-link">Contacto</a>
            </nav>
        </header>

        <main class="shadow-sm p-4 rounded">
            <form class="mb-3" id="form-buscar-local">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar producto (filtrado local)..." name="termino_busqueda_local" v-model="terminoBusqueda">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar Local</button>
                    </div>
                </div>
            </form>

            <form class="mb-3" method="GET" action="buscar_productos.php" id="form-buscar-servidor">
                <h2>Buscar Productos (Servidor)</h2>
                <div class="form-row align-items-center">
                    <div class="col-md-4 mb-2">
                        <input type="text" class="form-control" placeholder="Buscar por nombre..." name="nombre">
                    </div>
                    <div class="col-md-4 mb-2">
                        <select class="form-control" name="categoria">
                            <option value="">Todas las categorías</option>
                            <option value="cafes">Cafés</option>
                            <option value="bebidas_frias">Bebidas Frías</option>
                            <option value="comida">Comida</option>
                        </select>
                    </div>
                    <div class="col-md-auto mb-2">
                        <button class="btn btn-primary" type="submit">Buscar en Menú</button>
                    </div>
                </div>
            </form>

            <section>
                <h2>Nuestros Cafés</h2>
                <div class="menu-item" v-for="(cafe, index) in cafesFiltrados" :key="'cafe_' + index">
                    <div class="menu-item-details">
                        <h3>{{ cafe.nombre }}</h3>
                        <p class="precio">${{ cafe.precio }}</p>
                        <p class="descripcion">{{ cafe.descripcion }}</p>
                    </div>
                    <div class="order-controls">
                        <label :for="'espresso_qty_' + index">Cantidad:</label>
                        <input type="number" :id="'espresso_qty_' + index" name="'espresso_qty_' + index" class="quantity-input" value="0" min="0" v-model="cantidadesCafe[index]" @change="actualizarPedido(cafe.nombre, cantidadesCafe[index])">
                        <span v-if="cantidadesCafe[index] > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
            </section>

            <section>
                <h2>Bebidas Frías</h2>
                <div class="menu-item" v-for="(bebida, index) in bebidasFriasFiltradas" :key="'bebida_' + index">
                    <div class="menu-item-details">
                        <h3>{{ bebida.nombre }}</h3>
                        <p class="precio">${{ bebida.precio }}</p>
                        <p class="descripcion">{{ bebida.descripcion }}</p>
                    </div>
                    <div class="order-controls">
                        <label :for="'horchata_qty_' + index">Cantidad:</label>
                        <input type="number" :id="'horchata_qty_' + index" name="'horchata_qty_' + index" class="quantity-input" value="0" min="0" v-model="cantidadesBebidaFria[index]" @change="actualizarPedido(bebida.nombre, cantidadesBebidaFria[index])">
                        <span v-if="cantidadesBebidaFria[index] > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
            </section>

            <section>
                <h2>Nuestra Comida</h2>
                <div class="menu-item" v-for="(comida, index) in comidaFiltrada" :key="'comida_' + index">
                    <div class="menu-item-details">
                        <h3>{{ comida.nombre }}</h3>
                        <p class="precio">${{ comida.precio }}</p>
                        <p class="descripcion">{{ comida.descripcion }}</p>
                    </div>
                    <div class="order-controls">
                        <label :for="'comida_qty_' + index">Cantidad:</label>
                        <input type="number" :id="'comida_qty_' + index" name="'comida_qty_' + index" class="quantity-input" value="0" min="0" v-model="cantidadesComida[index]" @change="actualizarPedido(comida.nombre, cantidadesComida[index])">
                        <span v-if="cantidadesComida[index] > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
            </section>

            <div v-if="pedido.length > 0" class="mb-3">
                <h2>Tu Pedido</h2>
                <ul>
                    <li v-for="(item, index) in pedido" :key="'pedido_' + index">
                        {{ item.nombre }} x {{ item.cantidad }}
                    </li>
                </ul>
            </div>

            <button class="btn btn-primary btn-block mt-3">Ver Pedido</button>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>
        new Vue({
            el: '#app-menu',
            data: {
                terminoBusqueda: '',
                cafes: [
                    { nombre: 'Espresso', precio: 2.50, descripcion: 'Un shot de café concentrado y aromático.' },
                    { nombre: 'Cappuccino', precio: 3.00, descripcion: 'Espresso con leche vaporizada y espuma.' },
                    { nombre: 'Latte', precio: 3.25, descripcion: 'Espresso con mucha leche vaporizada y poca espuma.' }
                    // ... más cafés
                ],
                bebidasFrias: [
                    { nombre: 'Horchata', precio: 1.75, descripcion: 'Bebida refrescante a base de arroz y especias.' },
                    { nombre: 'Licuado (Fresa)', precio: 2.25, descripcion: 'Licuado cremoso de fresas frescas.' },
                    { nombre: 'Refresco (Soda)', precio: 1.50, descripcion: 'Variedad de refrescos carbonatados.' }
                    // ... más bebidas frías
                ],
                comida: [
                    { nombre: 'Sándwich de Pollo', precio: 4.50, descripcion: 'Sándwich con pollo a la parrilla, lechuga y tomate.' },
                    { nombre: 'Sándwich de Jamón', precio: 4.00, descripcion: 'Sándwich con jamón, queso y mostaza.' },
                    { nombre: 'Croissant', precio: 2.00, descripcion: 'Crujiente croissant recién horneado.' },
                    { nombre: 'Desayuno Casero', precio: 5.50, descripcion: 'Huevos al gusto, frijoles, plátano frito y queso.' }
                    // ... más comida
                ],
                cantidadesCafe: {},
                cantidadesBebidaFria: {},
                cantidadesComida: {},
                pedido: []
            },
            computed: {
                cafesFiltrados: function() {
                    const termino = this.terminoBusqueda.toLowerCase();
                    return this.cafes.filter(function(cafe) {
                        return cafe.nombre.toLowerCase().includes(termino) || cafe.descripcion.toLowerCase().includes(termino);
                    });
                },
                bebidasFriasFiltradas: function() {
                    const termino = this.terminoBusqueda.toLowerCase();
                    return this.bebidasFrias.filter(function(bebida) {
                        return bebida.nombre.toLowerCase().includes(termino) || bebida.descripcion.toLowerCase().includes(termino);
                    });
                },
                comidaFiltrada: function() {
                    const termino = this.terminoBusqueda.toLowerCase();
                    return this.comida.filter(function(comida) {
                        return comida.nombre.toLowerCase().includes(termino) || comida.descripcion.toLowerCase().includes(termino);
                    });
                }
            },
            methods: {
                actualizarPedido: function(nombre, cantidad) {
                    const cantidadInt = parseInt(cantidad);
                    const index = this.pedido.findIndex(item => item.nombre === nombre);

                    if (cantidadInt > 0) {
                        if (index > -1) {
                            this.pedido[index].cantidad = cantidadInt;
                        } else {
                            this.pedido.push({ nombre: nombre, cantidad: cantidadInt });
                        }
                    } else if (cantidadInt === 0 && index > -1) {
                        this.pedido.splice(index, 1);
                    }
                }
            }
        });
    </script>
</body>
</html>