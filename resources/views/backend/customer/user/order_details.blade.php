       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              



              <div class="card" >
              <div class="card-header">
                
                  <b>Bestelldetails</b>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
     

                      
                     @php
                     
                          $today = now(); 
                     
                     @endphp
                     

                         
                         
                
                      
           
                    
                    
                        @php
                            // Calculate the date 21 days after 'created_at'
                            $dateAfter21Days = $order->created_at->addDays(21)->format('d.m.Y');

                            // Get the current date and check if 21 days have passed
                            $isExpired = now()->greaterThanOrEqualTo($dateAfter21Days);
                            
                             $return30Days = $order->created_at->addDays(30)->format('d.m.Y');
                             
                        @endphp
                    
                     
                         
                    
                     
                      
                      <div class="row" style="padding:20px;border:1px solid #ccc;margin-bottom: 20px;">
                         
                         <div class="col-md-12">
                             
                             <div class="row" style="font-size:18px;">
                                 <div class="col-md-4" style="margin-bottom:15px;">
                                     <span style="font-size:20px;font-weight:700;"> Kaufdetails</span><br>
                                     <div class="samwidth">  
                                         <span class="eque">Bestelldatum</span>   : {{ $order->created_at->format('d-m-Y') }}
                                     
                                     </div> 
                                      <div class="samwidth"> 
                                          <span class="eque"> Rechnungsbetrag</span> :  <span  style="font-weight:700;"> €{{ number_format($order->new_sub_total,2, ',', '.') }}</span>
                                     
                                     </div> 
                                     
                                      <div class="samwidth"> 
                                          <span class="eque">Bestell-Nr.</span> :  {{$order->order_number}}
                                  
                                   </div> 
                                   <div class="samwidth">   
                                       <span class="eque">Status</span> :  <span  style="background-color:#90eee0;">@if($order->status== 'paid') Bezahlt @else  @endif </span>
                                  
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
                                 
                                 <div class="col-md-4" style="margin-bottom:15px;">
                                     
                                      <span style="font-size:20px;font-weight:700;">Versand und Rücksendung</span> <br> 
 
                                 <div class="samwidth">
                                    <span class="eque">Rückgabeantrag @if($isExpired)<span class="badge badge-pill badge-danger" > endete am</span> @else gültig bis @endif </span> : <span style="background-color:#90eee0;"> {{$dateAfter21Days}}</span>
                          </div>
                                 </div>
                                 
                                <div class="col-md-4" style="margin-bottom:15px;">
                              
                                    <span style="font-size:20px;font-weight:700;">Lieferadresse </span>  <br>
                                    {{$order->sfirst_name}}&nbsp; {{$order->slast_name}}<br>
                                    {{$order->sstreet_and_number}}&nbsp;{{$order->shouse_no}}<br>
                                    {{$order->spostcode}}&nbsp;{{$order->scity}}<br>
                                     {{$order->scountry}}
                                 </div>
                             </div>
                       
 
  
                             
                         </div>
                         
                       
                         
                       </div>
 
                 
                        <div class="row" style="padding:20px;border:1px solid #ccc;margin-bottom: 20px;">
                            
                            <div class="col-md-4">
                                


 <div style="border: 1px solid #d5d5d5;padding:30px 30px 30px 30px;margin-top:15px;font-size:18px;">
           @if($order->coupon_discount > 0)

                     
                             <div class="d-flex justify-content-between line " >
                                    <span class="fw-5 checkfont1">Gesamtpreis</span>
                                    <span class="total fw-5 checkfont1" id="original_subtotal_display">{{ number_format($order->new_sub_total+$order->coupon_discount, 2, ',', '.') }}&nbsp;€</span>
                            </div>

                            <div class="d-flex justify-content-between line " >

                                    
                                             @if($order->coupon_discount > 0)
                                            
                                   <span class="fw-5 checkfont1">Gutscheinrabatt</span>
                                    <span class="total fw-5 checkfont1" id="discount_display"> - {{ number_format($order->coupon_discount, 2, ',', '.') }}&nbsp;€</span>
                                                

                                            @else
                                            
                                   <span class="fw-5 checkfont1">Gutscheinrabatt</span>
                                    <span class="total fw-5 checkfont1" id="discount_display">- 0,00&nbsp;€</span>
                                     
                                                
                                            @endif
        
                            </div>
                           
                           
                        
                                    
                           <div class="d-flex justify-content-between line " style="border-bottom:1px solid #000;border-top:1px solid #000;">
                                    <span class="fw-5 checkfont1">Gesamt brutto</span>
                                    <span class="total fw-5 checkfont1" id="new_subtotal_display1" >{{ number_format($order->new_sub_total,2, ',', '.') }}&nbsp;€</span>
                            </div>
             

                     @else
          
                                <div class="d-flex justify-content-between line " style="border-bottom:1px solid #000;border-top:1px solid #000;display: flex; justify-content: center;">
                                  <span class="fw-5 checkfont1">Gesamt brutto</span>
                                    <span class="total fw-5 checkfont1" id="new_subtotal_display1" >{{ number_format($order->new_sub_total,2, ',', '.') }}&nbsp;€</span>
                            </div>     
      
                     
          @endif  
                                
                 
                             
                             <div class="d-flex justify-content-between line ">
                                    <span class="fw-5 checkfont">Versand</span>
                                    <span class="total fw-5 checkfont">0,00&nbsp;€</span>
                            </div>
                             <div class="d-flex justify-content-between line ">
                                    <span class="fw-5 checkfont">Gesamt netto</span>
                                    <span class="total fw-5 checkfont" id="price_without_vat_display">{{ number_format($order->price_without_vat,2, ',', '.') }}&nbsp;€</span>
                            </div>

                            <div class="d-flex justify-content-between line ">
                                    <span class="fw-5 checkfont">MwSt.&nbsp;{{ intval($order->tax_rate) }}&nbsp;% </span>
                                    <span class="total fw-5 checkfont" id="vat_display">{{ number_format($order->vat_amount,2, ',', '.') }}&nbsp;€</span>
                            </div>

                          
                            <div class="d-flex justify-content-between line " style="border-bottom:1px solid #000;border-top:1px solid #000;">
                                    <span class="fw-5 " style="font-weight:400;font-size:20px;">Rechnungsbetrag</span>
                                    <span class="total fw-5 " id="new_subtotal_display" ><span style="font-weight:700;font-size:22px;">{{ number_format($order->new_sub_total,2, ',', '.') }}&nbsp;€</span></span>
                            </div>
                          
                                </div>
                                
                                       <br>
 <p><a target="_blank" href="{{route('invoice.download',$order->id)}}"  title="Download"  class="btn btn-secondary  btn-sm rounded-pill" style="display:block;margin-bottom: 10px;width:220px;"> <i class="fas fa-download"> </i> Rechnung</a></p> 
 
      
        

<br>

@if($totalReturnRequestedPrice > 0)


 @if($order->returnRequests->isNotEmpty())
    @php
        $totalRefundedAmount = 0;
    @endphp

    @foreach($order->returnRequests as $returnRequest)


        @if($returnRequest->status == 'approved')
            @php
                $totalRefundedAmount += $returnRequest->total_price;
            @endphp
        @endif
    @endforeach

    @if($totalRefundedAmount > 0)
    <!-- Display the single total refunded amount -->
    
        @php
            // Get the latest approved return request if available
            $latestUpdated = $order->returnRequestsStatusApproved()->latest()->first()->approved_date ?? null;
        @endphp

    
    <p style="margin-top: 10px; font-weight: 500;background: #ffff0073;padding:10px;font-size:14px;">
     
       <span style="font-size:20px;font-weight:700;color:#000;"> Gesamtbetrag zurückerstattet: {{ number_format($totalRefundedAmount, 2, ',', '.') }}&nbsp;€</span> <br>
      Ihr Geld wurde am <span style="font-size: 17px; font-weight: 700;">{{ $latestUpdated ? \Carbon\Carbon::parse($latestUpdated)->format('d.m.Y') : 'N/A' }}</span> zurückerstattet.  Die Dauer der Überweisung ist ganz normal. Es kann vier bis fünf Tage dauern, bis das Geld auf Ihrem Konto eingeht.

    </p>
    @endif 
    
    
   @else
    <span class="badge badge-pill badge-secondary" style="background: red; color: #fff; margin-bottom:10px;display:none;">
        No refunds available
    </span>
@endif 



  
@else

@endif




     
        
                       </div>  <!--   end  class="col-md-4"-->

                                
          <!--   start class="col-md-8"-->
          <!--   start class="col-md-8"-->  
                            
         <div class="col-md-8" style="border: 0px solid gray;margin-bottom: 100px;border-left:1px solid #c9c9c9;">

            @if($returnRequest && $order->returnRequestsStatusPending && $order->returnRequestsStatusApproved->isEmpty() && $order->returnRequestsStatusRejected->isEmpty())

           <!-- start if($isExpired)-->
                   @if($isExpired) 

                   @else                  
                  
                    <!-- start Labelsetting true or false-->
                   @if(\App\Models\Labelsetting::getValue('free_return_label_enabled') === 'true')
                                <div class="row">
                                       <div class="col-md-12">
                                      <p> 
                                 
                            <!--  if($order->dhl_status == "Return")-->
                              @if($order->dhl_status == "Return" )
                              
                                    <!--   if(!empty($order->return_shipment_no))-->
                                          @if(!empty($order->return_shipment_no))
                                              <p>DHL Retourenlabel Sendungsnummer: {{ $order->return_shipment_no }}</p>

                                                      <!--   if(isset($order->return_shipment_no))-->
                                                         @if(isset($order->return_shipment_no))

                                                         <p style="font-size:14px;">Bitte besuchen Sie die Seite, um das DHL-Rücksendeetikett herunterzuladen. </p>     
                                                 <a href="{{ route('retuen.form', $order->id) }}" class="btn btn-info" style="margin-top:-12px;">
                                                        Rückgabebedingungen & DHL-Rücksendeetikett herunterladen
                                                     </a>
                               <p style="font-size:18px;color:red;margin-top:15px;">
                              Sie haben Anspruch auf NUR EINE KOSTENLOSE RÜCKSENDUNG von einem oder mehreren Artikeln für JEDE Bestellung! Bitte versenden Sie die Artikel bis zum <b>{{$return30Days}}</b>, andernfalls kann die Rückerstattung ungültig werden.</p>
                                 <hr style="border:1px solid #ccc;">

                                                         @else
                                                             <a class="btn btn-success">Sent To DHL <i class="fa fa-file-pdf" style="font-size:22px"></i></a>
                                                         @endif
                                                         <!-- end  if(isset($order->return_shipment_no))-->
                                          @else
                                              

                                          @endif
                                          <!-- end  if(!empty($order->return_shipment_no))-->
                                
                            @else
                            <!--else else else if($returnRequest)-->
                             

                            <!--condition if($order->new_sub_total > 500)-->
                            <!--condition if($order->new_sub_total > 500)-->
                            <!--condition if($order->new_sub_total > 500)-->
                            <!--condition if($order->new_sub_total > 500)-->
                            <!--condition if($order->new_sub_total > 500)-->
                            <!--condition if($order->new_sub_total > 500)-->
                            <!--condition if($order->new_sub_total > 500)-->
                            
                            <!-- 
                            
                            Middleware CheckOrderSubtotal and 
                          blade file condition if($order->new_sub_total > 1)

                           -->
                                    @if($order->new_sub_total > 1)

                                        <a href="{{ route('retuen.form', $order->id) }}" class="btn btn-warning">
                                            DHL Retourenlabel erstellen
                                        </a>
                                    
                                    
                                 <p style="font-size:18px;color:red;margin-top:15px;">Sie haben Anspruch auf NUR EINE KOSTENLOSE RÜCKSENDUNG von einem oder mehreren Artikeln für JEDE Bestellung! Bitte versenden Sie die Artikel bis zum <b>{{$return30Days}}</b>, andernfalls kann die Rückerstattung ungültig werden.  </p> 
                                 <hr style="border:1px solid #ccc;">
                                 
                                    @else
                                   
                                            <!-- if(empty($totalRefundedAmount))-->
                                                  @if(empty($totalRefundedAmount))
                                         <p style="color: #000; font-weight: 500;background-color: #32ff005c;padding:15px;font-size:14px;" >Your Return Request Accepted. If the DHL shipment is created and the item is on the way to your address, after received the items, please sent back to our address. The return is not valid for FREE Shipping due to order price {{ number_format($order->new_sub_total,2, ',', '.') }} EUR less than 900.00 EUR . Please send the items till <b>{{$return30Days}}</b> securely to our address as below with Tracking Number, and email us Tracking Number. Without Tracking Number, if it item is lost, we are not bound to refund you. Thanks for your understanding. 
                                              <span style="color:#000; font-weight: 500;padding:15px;font-size:14px;display:block;font-weight:700;">

                                                  <span style="font-size:14px;text-decoration: underline;">RETURN ADDRESS </span>  <br>
                                                  {{$order->sfirst_name}}&nbsp; {{$order->slast_name}}<br>
                                                  {{$order->sstreet_and_number}}&nbsp;{{$order->shouse_no}}<br>
                                                  {{$order->spostcode}}&nbsp; {{$order->scity}}<br>
                                                   {{$order->sstate}}&nbsp; {{$order->scountry}}
                                                                                  </span>

                                                  <b>After receiving the items and quality inspections, we will refund your money.</b>
                                                </p>
                                                @endif
                                              <!--end if(empty($totalRefundedAmount))-->
                                 
                                    @endif
                               <!--end if($order->new_sub_total > 500)-->
                           
                            
                            @endif
                     <!--end  if($order->dhl_status == "Return")-->
                            
                                    </p> 
                                  </div>
                                  </div>
                   @endif
                   <!-- end Labelsetting true or false-->
                              @endif
                    <!-- end  if($isExpired)-->
                                 

                                 
                                 
                                @endif
                    <!--  if($returnRequest)-->
                    <!--  if($returnRequest)-->
                    <!--  if($returnRequest)-->
                    <!--  if($returnRequest)-->
                                
                                
                                @if($orderItems->count()>0)     
                      
                                @foreach( $orderItems as $item)
                                <div style="border-bottom: 1px solid #c9c9c9;padding:15px;">
                                    <div class="row">
                                        <div class="col-md-2">
                                            @if ($item->product)
                                             
                                                @php
                                                $productUrl = $productUrls[$item->id] ?? '#';
                                                    $image = $item->product->featuredImage 
                                                        ? $item->product->featuredImage->image_path 
                                                        : ($item->product->images->first() ? $item->product->images->first()->image_path : null);
                                                @endphp
                                                 <a href="{{$productUrl}}" class="product-img" target="_blank"> 
                                                @if ($image)
                                               <img src="{{ asset( $image) }}" alt="" style="width:110px; height:auto;">
                                                @endif
                                                 </a>
                                            @endif
                                             
                                            
                                        </div>

                                        <div class="col-md-8" style="font-size:18px;">
                                            @if ($item->product)
                                                @php
                                                    $productUrl = $productUrls[$item->id] ?? '#';
                                                @endphp
                                                <a href="{{$productUrl}}" target="_blank" class="product-img"> 
                                                    {{$item->product->title}}
                                                </a>
                                            @endif
                                            <br>
                                             <div class="samwidth">
                                            <span class="equedetail">Preis</span> :  {{number_format($item->price,2, ',', '.')}} €
                                            </div>
                                             <div class="samwidth">
                                            <span class="equedetail">Menge</span> :  {{$item->qty}}
                                            </div>
                                             <div class="samwidth">
                                            <span class="equedetail">Größe</span> :  {{$item->size}}
                                            </div>
                                            <div class="samwidth">
                                            <span class="equedetail">Farbe</span> :  {{$item->color}}
                                            </div>
                                            
           <br>                                   <!-- Check if a return request exists for this item -->
@if(isset($returnRequests[$item->id]) && $returnRequests[$item->id])
    @if(isset($item->latestApprovedReturnRequest) && $item->latestApprovedReturnRequest->status === 'approved')
        <p style="color: #fff; font-weight: 500;pointer-events: none;" class="btn btn-success">Wir haben Ihre Erstattung für die Bestellung. </p>
    @elseif(isset($item->latestRejectedReturnRequest) && $item->latestRejectedReturnRequest->status === 'rejected')
        <p style="color: #fff; font-weight: 500;pointer-events: none;" class="btn btn-danger btn-sm">Rücksendung abgelehnt</p>
        <p style="color: #000; font-weight: 500; background-color: #ee909073;padding:5px 15px 5px 15px;">Artikel in einem bereits getragenen oder beschädigten Zustand bei uns eintrifft oder sich anderweitig in einem inakzeptablen Zustand befindet. Sie erhalten in Kürze eine E-Mail.</p>
    @else
        <p style="color: #fff; font-weight: 500;pointer-events: none;" class="btn btn-secondary btn-sm">Ihre Rücksendeanfrage wurde akzeptiert</p>
        <p style="color: #000; font-weight: 500; background-color: #feffd9;padding:5px 15px 5px 15px;">

            Nachdem wir Ihre Rücksendung erhalten haben, werden wir den retournierten Artikel prüfen und anschließend mit der Bearbeitung Ihrer Rückerstattung beginnen. Wenn ein Artikel in einem bereits getragenen oder beschädigten Zustand bei uns eintrifft oder sich anderweitig in einem inakzeptablen Zustand befindet, kann er abgelehnt. Für mehr information, klicken Sie bitte auf <a href="/retoure" target="_blank" style="color:#000;text-decoration: underline;">Retouren</a></p>
        
        @if(\App\Models\Labelsetting::getValue('free_return_label_enabled') === 'true')
        
        @else
        
        <p style="color: #000; font-weight: 500; background-color: #feffd9;padding:5px 15px 5px 15px;">
        Die Rücksendung kann mit einem Versanddienstleister Ihrer Wahl arrangiert werden. Bitte senden Sie die Retoure sicher zurück und bewahren den Einlieferbeleg inklusive der Sendungsnummer auf, damit bei Bedarf der Sendungsverlauf nachvollzogen werden kann.

Bitte verschicken Sie die entsprechenden Artikel inkl. etwaigen Zubehör – möglichst originalverpackt – an folgende Anschrift:<br><br>

                                    <span style="font-size:20px;font-weight:700;"> 
                                    AHKUNST <br>
                                    Inh. MD Saiful Alam<br>
                                    {{$order->street_and_number}}&nbsp;{{$order->house_no}}<br>
                                    {{$order->postcode}}&nbsp;{{$order->city}}<br>
                                    {{$order->country}}
                                    </span> 
                                    <br><br>
     Bitte versenden Sie die Artikel bis zum <b>{{$return30Days}}</b>, andernfalls kann die Rückerstattung ungültig werden.
                                    
                                     
        </p>
        @endif
        
<form class="cancel-return-form" action="{{ route('returns.cancel', $returnRequests[$item->id]->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Rückgabeanforderung stornieren</button>
</form>
    @endif
@endif

        <br>
        
                   
       
    <div>
       
       
    </div>


                                        </div>
                                        <div class="col-md-2">
                                            
                                            <p> 
                                              @if($item->product)
                                                <p> 
                                                    <a href="{{ route('reviews.create', $item->product->id) }}" title="View" class="btn btn-secondary btn-sm rounded-pill" style="display:block;margin-bottom: 10px;">
                                                       
            Schreib eine Produktrezension
        
                                                    </a>
                                                </p> 
                                                          @if(!$isExpired)
                                                            <p> 
                                                                @if( !$returnRequests[$item->id])
                                                                <a href="{{ route('return.create', [$item->product->id, 'order_id' => $order->id]) }}" title="View" class="btn btn-info btn-sm rounded-pill" style="display:block;margin-bottom: 10px;">
                                                                  Artikel zurückgeben
                                                                </a>
                                                                 @endif
                                                            </p> 
                                                        @endif
                                            @else
                                                <p>Kein Produkt verfügbar</p>
                                            @endif

                                             </p> 
                                        </div>
                                    </div>
                                    </div>
                                @endforeach



                  
                                    @else

                                    <div>
                                        <span style="color:red; font-size: 18px;" class="text-center">No Product Listed in the Order Detail !!</span>
                                    </div>

                                    @endif
                                
                            </div>
                            
                            
                        </div>
                 
                
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
    
    .equedetail{
        
        width:100px;
        float: left;
        
    }
    
    
    

           
           </style>
      
       @endsection
       
       
       
       
       
       @section('scripts')


<script>
    document.querySelectorAll('.cancel-return-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // prevent normal form submit

            Swal.fire({
                title: 'Bist du sicher?',
                text: "Möchtest du die Rückgabeanforderung wirklich stornieren?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ja, stornieren',
                cancelButtonText: 'Abbrechen',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // submit the form if confirmed
                }
            });
        });
    });
</script>



@endsection