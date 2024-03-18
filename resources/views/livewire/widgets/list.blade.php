<?php

use App\Models\Dashboard_Widget; 
use Illuminate\Database\Eloquent\Collection; 
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {

    public Collection $widgets;
 
    public function mount(): void
    {
        $this->getWidgets();
    } 

    #[On('widget-refresh')]
    public function getWidgets(): void
    {
        $this->widgets = Dashboard_Widget::where('user_id', Auth::id())->get();
    }
    

    public function delete(Dashboard_Widget $widget): void
    {
        $widget->delete();
 
        $this->dispatch("widget-refresh");
    }
}; ?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg"> 
        @foreach ($this->widgets as $widget)
            <x-dashboard-widget id="wdgt{{ $widget->id}}" data-id="{{$widget->id}}" style="height: {{$widget->height}}px;  width: {{$widget->width}}px; left: {{$widget->left}}px; top: {{ $widget->top}}px;">
                <div class="flex justify-between">
                    <p>This is widget: {{ $widget->id }}</p>
                    <span>
                        <button class="bg-red-500 text-white m-1 p-2 rounded" wire:click="delete({{ $widget->id }})" wire:confirm="Are you sure you want to delete this Widget">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </span>
                    
                </div>
            </x-dashboard-widget>

        @endforeach 
    </div>
</div>
