    function openNav() {
        document.getElementById("side").style.width = "250px";
        document.getElementById("maindiv").style.marginLeft = "250px";
        }

    function closeNav() {
        document.getElementById("side").style.width = "0";
        document.getElementById("maindiv").style.marginLeft= "0";
        }

    document.getElementById("pswchange").style.width


    //Profile form validation
    function validate(){
        var error = "";
        //validate dob

        //validate email
        var email_s = getElementById("email_s");
        var email_p = getElementById("email_p");
        if(email_s.value.indexOf("@") == -1 || email_p.value.indexOf("@") == -1 ){
            error = "wrong email format";
            document.getElementById("errors").innerHTML = error;
            return false;
        }

        //validate mobile phone
        var mobile_s = getElementById("mobile_s");
        var mobile_p = getElementById("mobile_p");
        var phoneno = /^\d{10}$/;
        if(mobile_s.value.match(phoneno) == null && mobile_p.value.match(phoneno) == null){
            error = "Invalid phone number";
            document.getElementById("errors").innerHTML = error;
            return false;
        }

        //validate county
        var county = getElementById("county");
        var letters = /^[A-Za-z]+$/;
        if(county.value.match(letters) == null){
            error = "County name cannot contain numbers!";
            document.getElementById("erros").innerHTML = error;
            return false;
        }else{
            return true;
        }

    }