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
    <div class="container mt-5">
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
            <form class="mb-3" id="form-buscar" action="buscar.php" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar producto..." name="termino_busqueda" v-model="terminoBusqueda">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>

            <section id="app-menu">
                <h2>Nuestros Cafés</h2>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Espresso</h3>
                        <p class="precio">$2.50</p>
                        <p class="descripcion">Un shot de café concentrado y aromático.</p>
                    </div>
                    <div class="order-controls">
                        <label for="espresso_qty">Cantidad:</label>
                        <input type="number" id="espresso_qty" name="espresso_qty" class="quantity-input" value="0" min="0" v-model="espressoCantidad" @change="actualizarPedido('Espresso', espressoCantidad)">
                        <span v-if="espressoCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>

                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Cappuccino</h3>
                        <p class="precio">$3.00</p>
                        <p class="descripcion">Espresso con leche vaporizada y espuma.</p>
                    </div>
                    <div class="order-controls">
                        <label for="cappuccino_qty">Cantidad:</label>
                        <input type="number" id="cappuccino_qty" name="cappuccino_qty" class="quantity-input" value="0" min="0" v-model="cappuccinoCantidad" @change="actualizarPedido('Cappuccino', cappuccinoCantidad)">
                        <span v-if="cappuccinoCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>

                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Latte</h3>
                        <p class="precio">$3.25</p>
                        <p class="descripcion">Espresso con mucha leche vaporizada y poca espuma.</p>
                    </div>
                    <div class="order-controls">
                        <label for="latte_qty">Cantidad:</label>
                        <input type="number" id="latte_qty" name="latte_qty" class="quantity-input" value="0" min="0" v-model="latteCantidad" @change="actualizarPedido('Latte', latteCantidad)">
                        <span v-if="latteCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>

                <h2>Bebidas Frías</h2>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Horchata</h3>
                        <p class="precio">$1.75</p>
                        <p class="descripcion">Bebida refrescante a base de arroz y especias.</p>
                    </div>
                    <div class="order-controls">
                        <label for="horchata_qty">Cantidad:</label>
                        <input type="number" id="horchata_qty" name="horchata_qty" class="quantity-input" value="0" min="0" v-model="horchataCantidad" @change="actualizarPedido('Horchata', horchataCantidad)">
                        <span v-if="horchataCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Licuado (Fresa)</h3>
                        <p class="precio">$2.25</p>
                        <p class="descripcion">Licuado cremoso de fresas frescas.</p>
                    </div>
                    <div class="order-controls">
                        <label for="licuado_fresa_qty">Cantidad:</label>
                        <input type="number" id="licuado_fresa_qty" name="licuado_fresa_qty" class="quantity-input" value="0" min="0" v-model="licuadoFresaCantidad" @change="actualizarPedido('Licuado (Fresa)', licuadoFresaCantidad)">
                        <span v-if="licuadoFresaCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Refresco (Soda)</h3>
                        <p class="precio">$1.50</p>
                        <p class="descripcion">Variedad de refrescos carbonatados.</p>
                    </div>
                    <div class="order-controls">
                        <label for="refresco_qty">Cantidad:</label>
                        <input type="number" id="refresco_qty" name="refresco_qty" class="quantity-input" value="0" min="0" v-model="refrescoCantidad" @change="actualizarPedido('Refresco (Soda)', refrescoCantidad)">
                        <span v-if="refrescoCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>

                <h2>Nuestra Comida</h2>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Sándwich de Pollo</h3>
                        <p class="precio">$4.50</p>
                        <p class="descripcion">Sándwich con pollo a la parrilla, lechuga y tomate.</p>
                    </div>
                    <div class="order-controls">
                        <label for="sandwich_pollo_qty">Cantidad:</label>
                        <input type="number" id="sandwich_pollo_qty" name="sandwich_pollo_qty" class="quantity-input" value="0" min="0" v-model="sandwichPolloCantidad" @change="actualizarPedido('Sándwich de Pollo', sandwichPolloCantidad)">
                        <span v-if="sandwichPolloCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Sándwich de Jamón</h3>
                        <p class="precio">$4.00</p>
                        <p class="descripcion">Sándwich con jamón, queso y mostaza.</p>
                    </div>
                    <div class="order-controls">
                        <label for="sandwich_jamon_qty">Cantidad:</label>
                        <input type="number" id="sandwich_jamon_qty" name="sandwich_jamon_qty" class="quantity-input" value="0" min="0" v-model="sandwichJamonCantidad" @change="actualizarPedido('Sándwich de Jamón', sandwichJamonCantidad)">
                        <span v-if="sandwichJamonCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Croissant</h3>
                        <p class="precio">$2.00</p>
                        <p class="descripcion">Crujiente croissant recién horneado.</p>
                    </div>
                    <div class="order-controls">
                        <label for="croissant_qty">Cantidad:</label>
                        <input type="number" id="croissant_qty" name="croissant_qty" class="quantity-input" value="0" min="0" v-model="croissantCantidad" @change="actualizarPedido('Croissant', croissantCantidad)">
                        <span v-if="croissantCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>
                <div class="menu-item">
                    <div class="menu-item-details">
                        <h3>Desayuno Casero</h3>
                        <p class="precio">$5.50</p>
                        <p class="descripcion">Huevos al gusto, frijoles, plátano frito y queso.</p>
                    </div>
                    <div class="order-controls">
                        <label for="desayuno_casero_qty">Cantidad:</label>
                        <input type="number" id="desayuno_casero_qty" name="desayuno_casero_qty" class="quantity-input" value="0" min="0" v-model="desayunoCaseroCantidad" @change="actualizarPedido('Desayuno Casero', desayunoCaseroCantidad)">
                        <span v-if="desayunoCaseroCantidad > 0" class="text-success ml-2">Añadido</span>
                    </div>
                </div>

                <div v-if="pedido.length > 0" class="mb-3">
                    <h2>Tu Pedido</h2>
                    <ul>
                        <li v-for="(item, index) in pedido" :key="index">
                            {{ item.nombre }} x {{ item.cantidad }}
                        </li>
                    </ul>
                </div>

                <button class="btn btn-primary btn-block mt-3">Ver Pedido</button>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script>
        new Vue({
            el: '#app-menu',
            data: {
                espressoCantidad: 0,
                cappuccinoCantidad: 0,
                latteCantidad: 0,
                horchataCantidad: 0,
                licuadoFresaCantidad: 0,
                refrescoCantidad: 0,
                sandwichPolloCantidad: 0,
                sandwichJamonCantidad: 0,
                croissantCantidad: 0,
                desayunoCaseroCantidad: 0,
                terminoBusqueda: '',
                pedido: [] // Array para almacenar los items del pedido
            },
            methods: {
                actualizarPedido: function(nombre, cantidad) {
                    const cantidadInt = parseInt(cantidad);
                    if (cantidadInt > 0) {
                        const itemExistente = this.pedido.find(item => item.nombre === nombre);
                        if (itemExistente) {
                            itemExistente.cantidad = cantidadInt;
                        } else {
                            this.pedido.push({ nombre: nombre, cantidad: cantidadInt });
                        }
                    } else if (cantidadInt === 0) {
                        const index = this.pedido.findIndex(item => item.nombre === nombre);
                        if (index > -1) {
                            this.pedido.splice(index, 1);
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>