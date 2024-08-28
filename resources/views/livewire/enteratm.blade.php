<?php

use App\Models\Atm;
use App\Models\Bank;
use Livewire\Volt\Component;

new class extends Component {
   
    public $atm;
    public $isActive=false;

    public function mount($id)
    {
        $this->atm= Atm::with(['bank','countrie','state'])->findOrFail($id);
    }
    
    public function activeCount()
    {

    }
    

}; ?>

<div class="mt-8">
    <div class="mt-16 flex grid grid-cols-5 gap-8 justify-between">
        <div class=" grid col-span-3 rounded-lg px-8 py-8 border border-gray-600 ">
            <div class="avatar flex justify-between  py-4">
                <div class="  r">
                    <img class="rounded-lg" src="../storage/{{$atm->bank->logo}}" />
                </div>
                <ul>
                    <li><b>BANCO : </b>{{$atm->bank->name}}</li>
                    <li><b>N série : </b>{{$atm->serialNumber}}</li>
                    <li><b>Endereço : </b>{{$atm->state->name.'-'.$atm->bairro}}</li>
                </ul>
            </div>
            <div class=" shadow">
                <div class="stat">

                     @if($isActive)
                            <div class="stat-value text-center">00</div>
                      @endif

                    <div class="mt-8 border-t py-6 border-gray-600 ">
                        <button onclick="my_modal_1.showModal()"
                            class="w-full btn btn-outline btn-success mt-8/ text-lg text-white font-semibold">Inserir
                            cartão multicaixa</button>
                    </div>
                </div>
            </div>

        </div>
        <!--DIGITOS--->
        <div class=" border border-gray-600  grid col-span-2 rounded-lg px-20 py-8">
            <h3 class="text-blue-400 text-center font-semibold">DIGITALIZAR</h3>

            <div class="flex gap-4 grid grid-cols-4 container mx-auto  ">
                @for($i=0;$i<=9;$i++) <button class="btn btn-primary text-white rounded-xl font-semibold">
                    {{$i}}</button>
                    @endfor
                    <button class="btn btn-warning font-semibold text-white">00</button>
                    <button class="btn btn-success font-semibold text-white"> Ok </button>
            </div>
        </div>
    </div>

    <dialog id="my_modal_1" class="modal">
        <div class="modal-box">
        <div class="mt-8 border-b py-6 border-gray-600 ">
            <h3 class="text-lg font-bold text-center">LEITOR DE MULTICAIXAS</h3>
        </div>
            <div class="modal-body">
                    <div class="col mb-0 ">
            
                    <div class="container p-4">
                        <div id="reader"></div>
                        <h2 id="scanResultText"></h2>
                  
                        <button id="refreshButton" onclick="refreshScanner()">Repetir</button>
                      </div>
                    <br>
                    <script src="https://unpkg.com/html5-qrcode"></script>
                    <script>
                      // Function to handle successful QR code scans
                      function onScanSuccess(decodedText, decodedResult) {
                        console.log(`Resultado: ${decodedText}`, decodedResult);

                        if (isValidUrl(decodedText)) {
                          var scanResultLink = document.getElementById("scanResultUrl");
                          scanResultLink.href = decodedText;
                           alert("Código decodificado com sucesso...");      
                              window.location.href = decodedText;
                        } else {
                             
                                
                               
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
                      var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });

                      // Render the QR code scanner with the defined success callback
                      html5QrcodeScanner.render(onScanSuccess);
                    </script>
                </div>
              </div>
             <div class="modal-footer">
               <h6 CLASS="text-center text-success">LEITOR DE Código QR</h6>
            </div>

            <div class="modal-action">
                <form method="dialog">
                   
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

</div>