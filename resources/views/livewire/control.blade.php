<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <form wire:submit.prevent="save">
                        <input type="text" wire:model="name" placeholder="Name"/>
                        <button type="submit" class="btn btn-success" > Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
