<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://github.com/MatheusPrudente/QRCODE/blob/main/style.css"   type="text/css" >

   <style>
    .wrapper{
  height: 265px;
  max-width: 410px;
 
  border-radius: 7px;
  padding: 20px 25px 0;
  transition: height 0.2s ease;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.wrapper.active{
  height: 530px;
}
header h1{
  font-size: 21px;
  font-weight: 500;
}
header p{
  margin-top: 5px;
  color: #575757;
  font-size: 16px;
}
.wrapper .form{
  margin: 20px 0 25px;
}
.form :where(input, button){
  width: 100%;
  height: 55px;
  border: none;
  outline: none;
  border-radius: 5px;
  transition: 0.1s ease;
}
.form input{
  font-size: 18px;
  padding: 0 17px;
  border: 1px solid #999;
}
.form input:focus{
  box-shadow: 0 3px 6px rgba(0,0,0,0.13);
}
.form input::placeholder{
  color: #999;
}
.form button{
  color: #fff;
  cursor: pointer;
  margin-top: 20px;
  font-size: 17px;
  background: #3498DB;
}
.qr-code{
  opacity: 0;
  display: flex;
  padding: 33px 0;
  border-radius: 5px;
  align-items: center;
  pointer-events: none;
  justify-content: center;
  border: 1px solid #ccc;
}
.wrapper.active .qr-code{
  opacity: 1;
  pointer-events: auto;
  transition: opacity 0.5s 0.05s ease;
}
.qr-code img{
  width: 170px;
}
@media (max-width: 430px){
  .wrapper{
    height: 255px;
    padding: 16px 20px;
  }
  .wrapper.active{
    height: 510px;
  }
  header p{
    color: #696969;
  }
  .form :where(input, button){
    height: 52px;
  }
  .qr-code img{
    width: 160px;
  }  
}
   </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>

<body>
    <section>
        <div class=" container mx-auto mt-6 px-6 py-8 wx-full rounded-lg  bg-gray-800">
            <x-bank.manu-bank />
            @yield('content')
        </div>
    </section>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode"></script>
 <script>
    const wrapper = document.querySelector(".wrapper"),
qrInput = wrapper.querySelector(".form input"),
generateBtn = wrapper.querySelector(".form button"),
qrImg = wrapper.querySelector(".qr-code img");
let preValue;
generateBtn.addEventListener("click", () => {
    let qrValue = qrInput.value.trim();
    if(!qrValue || preValue === qrValue) return;
    preValue = qrValue;
    generateBtn.innerText = "Generating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
    qrImg.addEventListener("load", () => {
        wrapper.classList.add("active");
        generateBtn.innerText = "Generate QR Code";
    });
});
qrInput.addEventListener("keyup", () => {
    if(!qrInput.value.trim()) {
        wrapper.classList.remove("active");
        preValue = "";
    }
});
 </script>
</body>

</html>