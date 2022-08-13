<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <button wire:click="scrapNow" wire:loading.attr="disabled" type="submit" class="btn btn-success btn-sm mr-2">
        <span wire:loading.remove wire:target="scrapNow">Scrap {{ ucwords($type) }}</span>
        <span class="d-none" wire:loading.class.remove="d-none" wire:target="scrapNow">
            Scrapping...
            <span class="spinner-border spinner-border-sm btn-spinner ml-2 mr-2" role="status" aria-hidden="true">
            </span>
        </span>
    </button>
</div>