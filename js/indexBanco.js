function TesteBanco(){
	var mysql = require('mysql');

	var con = mysql.createConnection({
  	host: "localhost",
  	user: "root",
  	password: "senhaFraca",
  database: "dbrepublica"
});

con.connect(function(err) {
  if (err) throw err;
  console.log("Connected!");
  //Insert a record in the "customers" table:
  var sql = "select * from  assinatura;";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log("1 record inserted");
  });
});
};