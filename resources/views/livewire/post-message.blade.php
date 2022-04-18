<div class="container mx-auto">
    <div class="w-full h-full">
        <x-card title="Messages">

            <div class="relative w-full p-6 overflow-y-auto max-h-fit">
                <ul class="space-y-2">
                    @forelse ($messages as $message)
                        <li class="flex justify-end">
                            <div class="flex-col">
                                <div class="relative max-w-xl px-4 py-2 text-gray-700 bg-gray-100 rounded shadow">
                                    <span class="block"> {!! $message['conversation'] !!}</span>
                                </div>
                                <span class="text-xs">{{ $message['convo_time'] }}</span>
                            </div>

                        </li>

                        <li class="flex justify-start">
                            <div class="flex-col">
                                <div class="relative max-w-xl px-4 py-2 text-gray-700 rounded shadow">
                                    <span class="block">
                                        {!! $message['response'] !!}
                                    </span>
                                </div>
                                <span class="text-xs">{{ $message['response_time'] }}</span>
                            </div>
                        </li>
                    @empty
                    @endforelse
                </ul>
            </div>

            <x-slot name="footer">
                <form wire:submit.prevent="submitText">
                    <div class="flex-col">
                        <x-input name="textInput" wire:model.defer="textInput" />
                        <div class="flex justify-end mt-4">
                            <x-button primary label="Submit" icon="paper-airplane" />
                        </div>
                    </div>
                </form>
            </x-slot>
        </x-card>
    </div>
</div>
