       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              
@php

@endphp


              <div class="card" >
              <div class="card-header">
                
                  <b>Meine Bestellungen
                      ({{$orders->total()}})</b>
                  
<form method="GET" action="{{ route('myorder') }}" class="mb-4">
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="q">🔍 Suchen:</label>
            <input
                type="text"
                name="q"
                id="q"
                value="{{ request('q') }}"
                placeholder="z. B. Bestellnummer, Produktname..."
                class="form-control"
            />
        </div>

        <div class="col-md-3">
            <label for="from">Von Datum:</label>
            <input type="text" name="from" id="from" class="form-control" placeholder="tt.mm.jjjj" value="{{ request('from') }}">
        </div>

        <div class="col-md-3">
            <label for="to">Bis Datum:</label>
            <input type="text" name="to" id="to" class="form-control" placeholder="tt.mm.jjjj" value="{{ request('to') }}">
        </div>

        <div class="col-md-2 align-self-end d-flex gap-2">
            <button type="submit" class="btn btn-primary w-100">Filtern</button>&nbsp;
            <button type="button" id="resetButton" class="btn btn-secondary w-100">Zurücksetzen</button>
        </div>
    </div>
</form>





              </div>
              <!-- /.card-header -->
              <div class="card-body">
     
                  

                      
                     @php
                     
                          $today = now(); 
                     
                     @endphp
                     

                         
                         
                 
                      
                 @if($orders->count()>0)     
                 
                   <?php $crn = ($orders->currentpage()-1)* $orders->perpage() + 1; ?>  
                 
                    @foreach( $orders as $order)  
                    
                    
                        @php
                            // Calculate the date 21 days after 'created_at'
                            $dateAfter21Days = $order->created_at->addDays(21)->format('d.m.Y');

                            // Get the current date and check if 21 days have passed
                            $isExpired = now()->greaterThanOrEqualTo($dateAfter21Days);
                        @endphp
                    
                     
                         
                    
                      <?php $rowClass = $loop->iteration % 2 == 0 ? 'bg-color-even' : 'bg-color-odd'; ?> <!-- Alternating class -->
                      
                      <div class="row {{ $rowClass }}" style="padding:20px;border:1px solid #ccc;margin-bottom: 20px;">
                         
                         <div class="col-md-10">
                             <div class="row" style="font-size:18px;margin-bottom: 10px;background-color:rgb(209 209 209);">
                                 <div class="col-md-4">
                                      <span style="margin-right:40px;">BESTELLUNG AUFGEGEBEN : <span  style="font-weight:700;">{{ $order->created_at->format('d.m.Y') }}</span></span>  
                                 </div>
                                 <div class="col-md-8">
                      <span> SUMME : <span  style="font-weight:700;">{{ number_format($order->new_sub_total,2, ',', '.') }}&nbsp;€</span></span>
                                 </div>
                             </div>
                             
                             <div class="row" style="font-size:18px;">
                                 <div class="col-md-4" style="margin-bottom:15px;">
                                     <span style="font-size:20px;font-weight:700;"> Kaufdetails</span><br>
                                     <div class="samwidth">  
                                         <span class="eque">Bestelldatum</span>   : {{ $order->created_at->format('d.m.Y') }}
                                     
                                     </div> 
                                      <div class="samwidth"> 
                                          <span class="eque"> Rechnungsbetrag</span> :  {{ number_format($order->new_sub_total,2, ',', '.') }}&nbsp;€
                                     
                                     </div> 
                                     
                                      <div class="samwidth"> 
                                          <span class="eque">Bestell-Nr.</span> :  {{$order->order_number}}
                                  
                                   </div> 
                                   <div class="samwidth">   
                                       <span class="eque">Status</span> :  <span  style="background-color:#90eee0;">@if($order->status== 'paid') Bezahlt @else  @endif</span>
                                  
                                   </div> 
            <div class="samwidth">
               <span class="eque">Zahlungsart</span> : 

					@if($order->payment_method == 'klarna')

					    <span  style="background-color:#90eee0;">Klarna</span>         

					 @elseif($order->payment_method == 'card')
					 <span  style="background-color:#90eee0;">Kreditkarte</span>  

					  @elseif($order->payment_method == 'PayPal')
					  <span  style="background-color:#90eee0;">PayPal</span>  

                            @else
                         
                          @endif



             </div>
                                     <div class="samwidth">
                                         <span class="eque">Rechnung-Nr.</span> : {{$order->invoice_number}}
                                     </div>

                                 </div>
                                 
                                 <div class="col-md-3" style="margin-bottom:15px;">
                                     
                                      <span style="font-size:20px;font-weight:700;">Versand und Rücksendung</span> <br> 
      
                                 <div class="samwidth">
                                     <span class="eque">Rückgabeantrag @if($isExpired)<span class="badge badge-pill badge-danger" > endete am</span> @else gültig bis @endif </span> : <span style="background-color:#90eee0;"> {{$dateAfter21Days}}</span>
                          </div>
                                      <br>         
                           <div class="samwidth">
                                  
                                         
 @if($order->returnRequests->isNotEmpty())
    @php
        $totalRefundedAmount = 0;
    @endphp

    @foreach($order->returnRequests as $returnRequest)

    <table style="width:100%;border-top:solid gray 1px;">
        <tr>
            <td style="width:50%;">
         <span style=" color: #000; margin-bottom:10px; display:block;text-align: left;font-size:14px;">
             Art: <b> {{ $returnRequest->product->title }}</b>:
        </span>   
            </td>
            <td style="width:50%;">
                @if($returnRequest->status == 'pending') <span class="badge badge-pill badge-warning" >Rücksendung<br>akzeptiert</span> @else  @endif
                @if($returnRequest->status == 'approved') <span class="badge badge-pill badge-success" >Rücksendung genehmigt<br>und erstattet</span> @else  @endif
                @if($returnRequest->status == 'rejected') <span class="badge badge-pill badge-danger" >Rücksendung abgelehnt</span> @else  @endif
            </td>
        </tr>

    </table>

        @if($returnRequest->status == 'approved')
            @php
                $totalRefundedAmount += $returnRequest->total_price;
            @endphp
        @endif
    @endforeach
        <hr style="width:100%;border-top:solid gray 1px;margin-top:2px;"> </hr>
            
       
    @if($totalRefundedAmount > 0)
    
  
        @php
            // Get the latest approved return request if available
            $latestUpdated = $order->returnRequestsStatusApproved()->latest()->first()->approved_date ?? null;
        @endphp

        <!-- Display the single total refunded amount -->
        <p style="margin-top: 10px; font-weight: 500; background: #ffff0073; padding: 10px; font-size: 14px;">
            Gesamtbetrag zurückerstattet: <span style="font-size: 17px; font-weight: 700;">{{ number_format($totalRefundedAmount, 2, ',', '.') }} €</span> <br>
            Ihr Geld wurde am <span style="font-size: 17px; font-weight: 700;">{{ $latestUpdated ? \Carbon\Carbon::parse($latestUpdated)->format('d.m.Y') : 'N/A' }} </span>zurückerstattet. Die Dauer der Überweisung ist ganz normal. Es kann vier bis fünf Tage dauern, bis das Geld auf Ihrem Konto eingeht.
        </p>
    @endif
    
    
@else
    <span class="badge badge-pill badge-secondary" style="background: red; color: #fff; margin-bottom:10px;display:none;">
        Keine Rückerstattung möglich
    </span>
@endif


                                     
                                 
                          </div>

                                 </div>
                                 
                                <div class="col-md-5" style="margin-bottom:15px;">
                              
                                    <span style="font-size:20px;font-weight:700;">Lieferadresse </span>  <br>
                                    {{$order->sfirst_name}}&nbsp; {{$order->slast_name}}<br>
                                    {{$order->sstreet_and_number}}&nbsp; {{$order->shouse_no}}<br>
                                    {{$order->spostcode}}&nbsp;{{$order->scity}}<br>
                                     {{$order->scountry}}
                                     <br><br>
                            

               
                @if(!empty($order->shipment_no)or $order->dhl_status == 'shipped' )
                 
                                       <div class="samwidth">
                                           <span class="eque">Versandpartner</span>: DHL 
                                      </div>
                <span style="font-size:14px;font-style: italic;">Die Sendung wurde am {{ \Carbon\Carbon::parse($order->shipment_label_create_date)->format('d.m.Y') }}  bearbeitet. 
</span>
                <div class="samwidth">
                    <span class="eque">Sendungsverfolgung</span>: {{$order->shipment_no}}
                 </div>
    <div class="samwidth">
        <span class="eque" style="visibility:hidden;">Shipping Carrier</span>: <a href="https://www.dhl.de/de/privatkunden/dhl-sendungsverfolgung.html?trackingnumber={{$order->shipment_no}}" target="_blank" class="btn btn-success">Link für Sendungsverfolgung</a>
    </div>

                      @else
                      @endif
                                 </div>
                             </div>
                       
 
                       
                             
                         
                             
                             <div class="row">
                                 
                                 <div class="col-md-12">
                                     
                                               
                        
                                 </div>
                                 
                                 
                             </div>
                             
                             
                         </div>
                         
                         <div class="col-md-2">
                      <div class="row">
                              <div class="col-md-12">
                                  <p><a id="buttonbtn{{$order->id}}" class="btn btn-warning  btn-sm rounded-pill" style="display:block;margin-bottom: 10px;"> Weitere Aktionen&nbsp;&nbsp;<i class="fas fa-chevron-circle-down"></i></a> </p>  
                                                      <div class="row">
                           <div class="col-md-12">
                          <p> <a href="{{route('orderDetails',$order->id)}}"  title="View"  class="btn btn-secondary btn-sm rounded-pill" style="display:block;margin-bottom: 10px;"> Bestelldetails</a></p> 
                      </div>
                      </div>
                       <div id="buttondivshowhide{{$order->id}}">
                        
                     
                        @if($isExpired) @else <p><a href="{{route('orderDetails',$order->id)}}"  title="View"  class="btn btn-secondary  btn-sm rounded-pill" style="display:block;margin-bottom: 10px;"> Artikel zurückgeben </a></p>  @endif  
                        </div> 
                       </div>
                       </div>

                       <div class="row">
                           <div class="col-md-12">
                            <p><a target="_blank" href="{{route('invoice.download',$order->id)}}"  title="Download"  class="btn btn-secondary  btn-sm rounded-pill" style="display:block;margin-bottom: 10px;"> <i class="fas fa-download"> </i> Rechnung</a></p> 
                      </div>
                      </div>
                             
                     <div class="row">
                           <div class="col-md-12">
                          <p> <a href="{{route('orderDetails',$order->id)}}"  title="View"  class="btn btn-secondary btn-sm rounded-pill" style="display:block;margin-bottom: 10px;">
            Produktrezension
        </a></p> 
                      </div>
                      </div>
                      <div class="row">
                           <div class="col-md-12">
                          <p> <a href="{{route('open.ticket',$order->id)}}"  title="View"  class="btn btn-secondary btn-sm rounded-pill" style="display:block;margin-bottom: 10px;">Kontakt</a></p> 
                      </div>
                      </div>
                             

                             
                     
                             
                         </div>
                          

                         
                       </div>
 
                 
     
                  @endforeach
                  
                  @else
                  
                  <tr>
                      <td colspan="7" style="color:red; font-size: 18px;" class="text-center">Keine Bestellung gefunden!</td>
                  </tr>
                  
                @endif
                
     
                 
 
                 <h5 style="color:red;padding-top: 15px;">Aktuelle Seite {{$orders->currentPage()}} von {{$orders->firstItem()}} bis {{$orders->lastItem()}}</h5>
                  {{$orders->appends($_GET)->links('pagination-links')}}   
             
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
</div>
     
       <style>
           
.bg-color-even {
    background-color: #f2f2f2; /* Light gray for even rows */
}

.bg-color-odd {
    background-color: #dffbdb; /* White for odd rows */
}


 .samwidth {
        
        display:block;

        
    }
    
    .eque {
        
        width:190px;
        float: left;

    }
    

           
           </style>
      
       @endsection
       
       
       
       
       
       @section('scripts')


<script>
$(document).ready(function() {
    // Hide all toggle divs initially
    $('[id^=buttondivshowhideXXX]').hide();

    // Set up click event for each button
    $('[id^=buttonbtnXXX]').click(function() {
        // Get the order id from the button id
        var orderId = $(this).attr('id').replace('buttonbtn', '');
        
        // Toggle the corresponding div
        $('#buttondivshowhideXXX' + orderId).toggle();
    });
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#from", {
        locale: "de",
        dateFormat: "d.m.Y",
        defaultDate: "{{ request('from') }}"
    });

    flatpickr("#to", {
        locale: "de",
        dateFormat: "d.m.Y",
        defaultDate: "{{ request('to') }}"
    });

    document.getElementById('resetButton').addEventListener('click', function () {
        const baseUrl = window.location.origin + window.location.pathname;
        window.location.href = baseUrl;
    });
});
</script>




@endsection