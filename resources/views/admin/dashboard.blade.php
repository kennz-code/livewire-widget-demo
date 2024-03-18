<x-app-layout>
    <x-slot name="header">
    <div class="flex flex-row justify-between">
        <div class="font-semibold text-xl text-gray-800">
            {{ __('Admin Dashboard') }}
        </div>
       
        <button class="bg-gray-900 p-3 rounded text-white" onclick=add_widget() >
         ADD
        </button>
      </div>
    </x-slot>


    <livewire:widgets.list/>


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  
<script>
  $( function() {
    let date = Date.now();
    date = date.toString()
    
    $('#widget_id').attr("value", date);
    
    $( "#draggable" ).resizable().draggable();
    $( "#resizable" ).resizable().draggable();

    $( "[id^=wdgt]" ).resizable().draggable();
   
    $( "[id^=wdgt]" ).on( "dragstop", function( event, ui ) 
    {
        
        $.ajax({
            type: "POST",
            url: `/admin/dashboard/update/${event.currentTarget.dataset.id}`,
            data: {
            "_token": "{{ csrf_token() }}",
            "_method": "PUT",
            'left_position': ui.position.left,
            'top_position': ui.position.top,
            
            }
        });
    } );

    $( "[id^=wdgt]" ).on( "resizestop", function( event, ui ) 
    {
        $.ajax({
            type: "POST",
            url: `/admin/dashboard/update/${event.currentTarget.dataset.id}`,
            data: {
            "_token": "{{ csrf_token() }}",
            "_method": "PUT",
            'widget_height': ui.size.height,
            'widget_width': ui.size.width,
            }
        });
    } );

  });

  function add_widget(){
    console.log("Touched by an angel");

     $.ajax({
            type: "POST",
            url: '/admin/dashboard',
            data: {
            "_token": "{{ csrf_token() }}",
            },
            success: function(data){
                console.log(data);
            }
        });
    Livewire.dispatch("widget-refresh")
  }


</script>
