<div>
    {{-- card 1 --}}
    <div class="card my-4">
        <div class="card-header">
            <h5>(1) Click with some actions</h5>
        </div>
        <div class="card-body text-center">
            <button class="btn btn-secondary" wire:click="decrement">-</button>
            <span class="fs-4 mx-4">{{ $count }}</span>
            <button class="btn btn-primary" wire:click="increment">+</button>
        </div>
    </div>

    {{-- card 2 --}}
    <div class="card my-4">
        <div class="card-header">
            <h5>(2) Data binding</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <input type="text" class="form-control" wire:model="message" value="{{ $message }}" />
                </div>
                <div class="col-sm-6">
                    <span class="fs-4 mx-4">{{ $message }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- card 3 --}}
    <div class="card my-4">
        <div class="card-header">
            <h5>(3) Data binding & Re-calculate other data : BMI Calculator</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <label>Weight in kg.</label>
                    <input type="number" class="form-control" wire:model="weight" value="{{ $weight }}" />
                    {{-- <input type="text" class="form-control" wire:model.debounce.1s="weight" value="{{ $weight }}" /> --}}

                </div>
                <div class="col-sm-4">
                    <label>Height in cm.</label>
                    <input type="number" class="form-control" wire:model="height" value="{{ $height }}" />
                    {{-- <input type="text" class="form-control" wire:model.debounce.1000ms="height" value="{{ $height }}" /> --}}
                </div>
                <div class="col-sm-4 text-center p-4">
                    <span class="fs-4 mx-4">{{ $bmi }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
