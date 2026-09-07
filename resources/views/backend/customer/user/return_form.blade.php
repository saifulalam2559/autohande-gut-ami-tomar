       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              
                        @php
                            // Calculate the date 21 days after 'created_at'
                            $dateAfter21Days = $order->created_at->addDays(21)->format('d.m.Y');

                            // Get the current date and check if 21 days have passed
                            $isExpired = now()->greaterThanOrEqualTo($dateAfter21Days);
                            
                             $return30Days = $order->created_at->addDays(30)->format('d.m.Y');
                             
                        @endphp


              <div class="card" >
              <div class="card-header">
                  
                                    <div class="row">
                        <div class="col-md-2">
          
      </div>
                  
                        <div class="col-md-8">
            <b>DHL Retourenlabel erstellen</b>
      </div>
                  
                  
                  
                        <div class="col-md-2">
          
      </div>
                      </div>
                
                
              </div>
              <!-- /.card-header -->

      


           <!-- /.card-header -->
              <div class="card-body">


                
						 <div class="container">

						              Bestellnummer:
						              <div style="font-size:22px;font-weight:600;">

						                                {{$order->order_number}}<br> <br> 

						                                @if(!empty($order->return_shipment_no))
						                        <p style="font-size:22px;font-weight:600;color:#000;">DHL Retourenlabel Sendungsnummer: {{ $order->return_shipment_no }}</p>
						                        @if(isset($order->return_shipment_no))
						                            <a href="{{ asset('return_labels/' . $order->return_shipment_no .'-'. 'Return.pdf') }}" download class="btn btn-success">
						                            Rücksendeetikett herunterladen <i class="fa fa-file-pdf" style="font-size:22px"></i>
						                            </a>
						                        @else
						                            <a class="btn btn-success"> <i class="fa fa-file-pdf" style="font-size:22px"></i></a>
						                        @endif
						                    @else
						                       
						                    @endif
						</div> <br> 
						 
						 


						@if(!empty($order->return_shipment_no))

						<div class="return-confirmation">
						   
						    <p>Bitte  drucken Sie Ihr Rücksendeetikett und kleben Sie es auf Ihr Paket. Anschließend kannst du deine Retoure bequem im nächsten DHL Filiale, DHL Paketshop oder Packstation der DHL abgeben.
                                                    Sie haben Anspruch auf NUR EINE KOSTENLOSE RÜCKSENDUNG von einem oder mehreren Artikeln für JEDE Bestellung.</p>

						   
						<br>
						    <b>Wichtige Hinweise</b>
						   
  <ul class="mt-2" style="list-style-type: disc; margin-left: 20px;">
                <li>Die Artikel müssen unbenutzt, unbeschädigt und in ihrer Originalverpackung sein.</li>
                <li>Alle beigefügten Etiketten und Anhänger müssen noch angebracht sein.</li>
                <li>Die Versandkosten für die Rücksendung sind für Ihre erste Rücksendung eines oder mehrerer retournierbarer Artikel für jede Bestellung innerhalb des Rücksendezeitfensters kostenlos.</li>
                <li>Bitte versenden Sie die Artikel bis zum <b>{{$return30Days}}</b>, andernfalls kann die Rückerstattung ungültig werden.</li>
            </ul>
						    
						    <br>
						    <b>Weitere Informationen</b>
						    <p>Bitte lesen Sie unsere Rückgabebedingungen sorgfältig durch. Weitere Informationen finden Sie unter <a href="/retoure">Rücksendung & Rückerstattung</a>.</p>
						</div>


						@else

						    <form action="{{ route('retuen.form.submit', $order->id) }}" method="POST">
						    @csrf
						    <div class="form-group">
						        <label for="return_reason">Bitte schreiben Sie nochmal kurz wegen Rücksendegrund.</label>
						        <textarea class="form-control" name="return_reason" id="summernoteX" placeholder="Enter return reason...">{{ old('return_reason') }}</textarea>
						        @error('return_reason')
						            <small class="text-danger">{{ $message }}</small>
						        @enderror
                                                    </div><br>

<div class="form-group">
    <div class="form-check d-flex align-items-start">
        <input type="checkbox" 
               class="form-check-input mt-1" 
               id="return_policy" 
               name="return_policy"
               style="width: 18px; height: 18px; margin-top: 2px;">
        <div class="ms-2">
            <label class="form-check-labelXX" for="return_policy" >
                <b>  Ich bestätige, alle zurückgegebenen Artikel müssen die folgenden Bedingungen erfüllen:</b>
            </label>
            <ul class="mt-2" style="list-style-type: disc; margin-left: 20px;">
                <li>Die Artikel müssen unbenutzt, unbeschädigt und in ihrer Originalverpackung sein.</li>
                <li>Alle beigefügten Etiketten und Anhänger müssen noch angebracht sein.</li>
                <li>Die Versandkosten für die Rücksendung sind für Ihre erste Rücksendung eines oder mehrerer retournierbarer Artikel für jede Bestellung innerhalb des Rücksendezeitfensters kostenlos.</li>
                <li>Ich muss die Artikel innerhalb von 30 Tagen nach dem Bestelldatum zurücksenden.</li>
            </ul>
        </div>
    </div>
    @error('return_policy')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>




						    <button type="submit" class="btn btn-dark">Senden und erstellen Sie PDF Rücksendeetikett</button>
						    <a href="{{ route('myorder') }}" class="btn btn-secondary">Abbrechen</a>
						</form>
						@endif

						<br><br><br>
              		</div>

               </div>
              <!-- /.card-body -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
</div>
     
       <style>
           
 
           input#return_policy.form-check-input.mt-1 {
               height:24px !important;
               margin-right: 10px !important;
               width:38px !important;
           }
    

           
           </style>
      
       @endsection
       
       
       
       
       
       @section('scripts')






@endsection