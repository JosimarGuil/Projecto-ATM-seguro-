@extends('layouts.base')
@section('title','Leitor de cartão')

@section('content')
<div>
<img src="../storage/{{$atm->bank->logo}}" style="display: block; margin: auto; height: auto;" class="wx-auto display mt-4" >
    <button onclick="my_modal_2.showModal()"
        class="w-full btn btn-outline btn-success mt-16 mt-8/ text-lg text-white font-semibold " @click="open = ! open">Inserir
        cartão multicaixa</button> 
    <dialog id="my_modal_2" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold">Hello!</h3>

            <div class="col mb-0 " style="border-radius: non;">

                <div class="container">
                    <div id="reader"></div>

                    <small>
                        <a id="scanResultUrl" target="_blank" href="scanResultUrl" style="color: blue;"></a>
                    </small>
                    <button id="refreshButton" onclick="refreshScanner()">Repetir</button>
                </div>
                <br>
                <!--API DE LEITURA DE QR CODE-->
                <script src="https://unpkg.com/html5-qrcode"></script>
                <script>
                // Function to handle successful QR code scans
                function onScanSuccess(decodedText, decodedResult) {
                    console.log(`Resultado: ${decodedText}`, decodedResult);
                    if (isValidUrl(decodedText)) {
                        var scanResultLink = document.getElementById("scanResultUrl");
                        scanResultLink.href = decodedText;
                        scanResultLink.innerText = decodedText;
                    } else {
                        alert("Verificando seus dados...");
                        let url=decodedText+'/{{$atm->id}}';
                        window.location.href =url;
                    }
                    html5QrcodeScanner.clear();
                    document.getElementById("refreshButton").style.display = "block";
                }
                // Function to refresh the QR code scanner
                function refreshScanner() {
                    location.reload(true);
                }
                // Function to validate URLs
                function isValidUrl(url) {
                    var pattern = new RegExp(
                        "^(https?:\\/\\/)?" +
                        "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|" +
                        "((\\d{1,3}\\.){3}\\d{1,3}))" +
                        "(\\:\\d+)?(\\/[-a-z\\d%@_.~+&:]*)*" +
                        "(\\?[;&a-z\\d%@_.,~+&:=-]*)?" +
                        "(\\#[-a-z\\d_]*)?$",
                        "i"
                    );
                    return !!pattern.test(url);
                }
                // Initialize the QR code scanner
                var html5QrcodeScanner = new Html5QrcodeScanner("reader", {
                    fps: 10,
                    qrbox: 250
                });

                // Render the QR code scanner with the defined success callback
                html5QrcodeScanner.render(onScanSuccess);
                </script>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</div>
@endsection