<h1>Hola mundo</h1>
<div id='container-prueba'>
    @foreach($pruebas as $prueba)
    <p>{{ $prueba->CodEmpleado }}</p> <!-- Reemplaza 'campo' por el nombre del campo que quieras mostrar -->
@endforeach
</div>

{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hacer la solicitud AJAX al servidor
        fetch('/pruebas')
            .then(response => response.json()) // Convertir la respuesta a JSON
            .then(data => {
                // Seleccionar el contenedor donde se mostrará el JSON
                const container = document.getElementById('container-prueba');
                
                // Convertir el JSON a un string bonito
                const jsonString = JSON.stringify(data, null, 2);

                // Mostrar el JSON en el contenedor
                container.innerHTML = `<pre>${jsonString}</pre>`;
            })
            .catch(error => console.error('Error:', error));
    });
</script> --}}