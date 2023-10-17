<div class="relative sm:flex sm:direction-column sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">

    <?php
        $columned = "display: flex; flex-direction: column; align-items: center; justify-content: center";
        $rowed = "display: flex; flex-direction: row; align-items: center; justify-content: center";
    ?>


    <div style="{{ $columned }}">

        <div style="{{ $rowed }}">
            <input type="number" wire:model.live="count" >
            &nbsp;
            <button wire:click="increment">+</button>
            &nbsp;
            <button wire:click="decrement">-</button>
        </div>

        <a href="/dashboard">
            Back to Dashboard
        </a>

    </div>

</div>
