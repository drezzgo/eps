//Para ver que si esta funcionando el codigo y se importa la libreria que se usa
//para manipular y usar la base de datos
console.log("Estoy ejecutandome")
const { Client } = require("pg");

const obtenerUsuarios = async () =>{
    //Se instancia el cliente con los datos que se necesitan para conectarse con
    //el servidor de elephantSQL y se conecta
    const client = new Client({
        user: "dwqxowhj",
        host: "motty.db.elephantsql.com",
        database: "dwqxowhj",
        password: "sz-EFm4YKG8qrV-kLK78D09h1RkrqxRC",
        port: 5432,
    });
    client.connect();
    
    //este es un query de prueba para rectificar que si estamos conectados
    const res = await client.query("SELECT * FROM usuario");
    const result = res.rows;
    
    //cierra la conexion con la base de datos
    await client.end();

    return result;
}

//imprimimos el resultado que se extrajo de la base de datos
obtenerUsuarios().then(result => { 
    console.log(result)
});