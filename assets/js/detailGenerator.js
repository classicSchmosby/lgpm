function passwordGen() {
	// create initial arrays.
    // create empty array, to be populated by letters.
    var a = [];
    // create array populated by special chars.
    var chars = [',', '/', ',', '#', '%', '^', '_', '-', '*', '£', '!', '?', '&', ';', '(', ')', '=', '+', '$'];
    // create for with letters a-z.
    for (var i = 97; i <= 122; i++) { // for start.
        // convert length of for from CharCode to String => to Upper Case.
    	a[a.length] = String.fromCharCode(i).toUpperCase();
        
        // create random letters for username variables.
        var one1 = a[Math.floor(Math.random() * a.length)];
        var two1 = a[Math.floor(Math.random() * a.length)];
        var three1 = a[Math.floor(Math.random() * a.length)];
        var four1 = a[Math.floor(Math.random() * a.length)];
        var five1 = a[Math.floor(Math.random() * a.length)];
    
        // create random letters for password variables.
  	    var one = a[Math.floor(Math.random() * a.length)];
        var two = a[Math.floor(Math.random() * a.length)];
        var three = a[Math.floor(Math.random() * a.length)];
        var four = a[Math.floor(Math.random() * a.length)];
        var five = a[Math.floor(Math.random() * a.length)];
        var six = a[Math.floor(Math.random() * a.length)];
        var seven = a[Math.floor(Math.random() * a.length)];
        var eight = a[Math.floor(Math.random() * a.length)];
        var nine = a[Math.floor(Math.random() * a.length)];
        var ten = a[Math.floor(Math.random() * a.length)];
    } // for end.
    // create random numbers for username.
    var intOne = Math.floor(Math.random() * 10);
    var intTwo = Math.floor(Math.random() * 10);
    var intDecimal = intOne.toFixed(0) + "." + intTwo.toFixed(0);

    // create random numbers for password.
    var int1 = Math.floor(Math.random() * 10);
    var int2 = Math.floor(Math.random() * 10);
    var ints = int1.toFixed(0) + int2.toFixed(0);
    
    // create random characters, based on array (chars).
    var randChar = chars[Math.floor(Math.random() * chars.length).toFixed(0)];

    // create variable string moving all letters, numbers and characters together for username.
    var u = (one1 + two1 + three1 + four1 + five1 + intDecimal).toString();
    
    // create variable string moving all letters, numbers and characters together for password.
    var p = (one + two + three + four + five + six + seven + eight + nine + ten + ints + randChar).toString();
    // Send password string to php variable.
    // c = '<?php echo $userPass ?>';

    // display username variable u.
    document.getElementById('username').innerHTML = u;
    // display password variable c.
    document.getElementById('userPass').innerHTML = p;
    // display all buttons and hints.
    document.getElementById('copyBtn').style.display = "inline";
    document.getElementById('copyBtn1').style.display = "inline";
    document.getElementById('passwordHint').style.display = "inline";
}
function copyBtn(text) {
  window.prompt("Copy: Ctrl+C", text);
}
function copyBtn1(text) {
  window.prompt("Copy: Ctrl+C", text);
}