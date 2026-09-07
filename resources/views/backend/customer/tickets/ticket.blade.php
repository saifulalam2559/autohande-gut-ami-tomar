       @extends('backend.layouts.master')
       @section('content')
       
       
       <div class="container-fluid">

       <div class="row userindex">
          <div class="col-12">
              @include('backend.layouts.notification')
              



            <div class="card">
              <div class="card-header">
                  <b>Meine Support-Tickets ({{$tickets->total()}})</b>
                <a style="color:#fff;" class="float-right btn btn-danger" href="{{route('new.ticket')}}">Neues Ticket</a>
              </div>
              <!-- /.card-header -->
              

              
              <div class="card-body">
                @if( count($tickets)> 0 )
                <table id="example1XXXX" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Datum</th>
                    <th>Service</th>
                    <th>Betreff</th>
                    <th>Prioritätsstufen</th>
                    <th>Status</th>
                 
                    <th>Aktion</th>
                  </tr>
                  </thead>
                  <tbody>
                      
               
               
                    <?php $crn = ($tickets->currentpage()-1)* $tickets->perpage() + 1; ?> 
                      
                @foreach($tickets as $row)
                    @php
                        // Check if this ticket has any unread replies not by the customer
                        $hasUnread = $row->replays()
                            ->where('user_id', '!=', Auth::id())
                            ->where('read_by_user', false)
                            ->exists();
                    @endphp
                    <tr class="{{ $hasUnread ? 'unread-reply' : '' }}">
                      <td> {{$crn++}}</td>
                      <td>{{ \Carbon\Carbon::parse($row->date)->format('d.m.Y') }}</td>
                      <td> {{$row->service}}</td>
                      <td> {{$row->subject}}</td>
                      
                      <td> 
                          
                          @if($row->priority=='Niedrig')
                          <span class="badge badge-warning">Niedrig</span>
                          @elseif($row->priority=='Mittel')
                          <span class="badge badge-warning">Mittel</span>
                          @elseif($row->priority=='Hoch')
                          <span class="badge badge-warning">Hoch</span>
                          @endif
                      
                      </td>
                      <td> 
                          
                          @if($row->status==0)
                          <span class="badge badge-secondary">Ausstehend</span>
                          @elseif($row->status==1)
                          <span class="badge badge-success">Antworten</span>
                          @elseif($row->status==2)
                          <span class="badge badge-danger">Geschlossen</span>
                          @endif
                      
                      </td>
                      
       
                
                
           

              
                      <td>     
                       <a href="{{route('show.ticket',$row->id)}}"  title="view"  class="btn btn-secondary btn-sm rounded-pill"> Anzeigen</a>
                      
                      
                      </td>
                      
                       <!-- Modal Start-->
                       
                       
                       <!-- Modal wider class modal-lg modal-xl -->
                       
  
                      
                  
                      
                   
                      
                       <!-- Modal End-->
                      
                      </tr>
                
               
     
                  @endforeach
                  </tbody>
                </table>
               <h5 style="color:red;padding-top: 15px;">Aktuelle Seite {{$tickets->currentPage()}} von {{$tickets->firstItem()}} bis {{$tickets->lastItem()}}</h5>
               
                   @else
                    <div id="centernofound">
                         <center> 
                        <h5 style="padding:50px 0 0 0;color:#000;">Bitte öffnen Sie ein Support-Ticket.</h5>
                        <br>          
              <a style="color:#fff;" href="{{route('new.ticket')}}" class=" btn btn-danger">Erstellung eines Supporttickets</a>
             </center> 
                    </div>

                    @endif
                    
                  {{$tickets->appends($_GET)->links('pagination-links')}} 
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
    .unread-reply {
        font-weight: 700 !important;
        color:blue !important; /* light blue */
    }
</style>

      
       @endsection
       
       
       @section('scripts')








@endsection