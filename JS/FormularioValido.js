    function verificar()
    {

        var nombre=document.getElementById("nombre").value;
        var email= document.getElementById("email").value;
        var password= document.getElementById("password").value;
        var numero= document.getElementById("numero").value;


        if (nombre.length < 3 )
        {
            alert("Error en el nombre");
            return false;
        }


        expr = /^[a-zA-Z]+\d{3}\@ikasle.ehu\.(eus|es)/g;


        if ( !expr.test(email) )
        {
            alert("Error en el tipo de email");
            return false;
        }




    if(password.length< 6){
        alert("Contraseña demasiado corta");
        return false;
    }

    exptel=/^[6-9]/g;
    if(numero.length!= 9 | !exptel.test(numero)){
        alert ("Númer de telefono incorrecto" );
        return false;

    }

        return true;
    }

    function archivo(evt) {
        var files = evt.target.files; // FileList object

        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imÃ¡genes.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            reader.onload = (function (theFile) {
                return function (e) {
                    // Insertamos la imagen
                    var Volver = document.getElementById(volver);
                    var Enviar = document.getElementById(enviar);
                    document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result, '" title="', escape(theFile.name), '"> </img></br>'].join('');
                    document.getElementById('list').insertBefore(volver, null);
                    document.getElementById('list').insertBefore(enviar, null);

                };
            })(f);

            reader.readAsDataURL(f);
        }

        document.getElementById('files').addEventListener('change', archivo, false);
    }