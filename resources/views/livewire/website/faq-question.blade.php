<div>
    <form wire:submit.prevent="submit">
        <div class="question-section login-section ">
            <div class="review-form">
                <h5 class="comment-title">{{ __('website.have_any_question') }}</h5>
                <div class=" account-inner-form">
                    <div class="review-form-name">
                        <label for="fname" class="form-label">{{ __('website.name') }}*</label>
                        <input wire:model.live="name" type="text" id="fname" class="form-control"
                               placeholder="{{ __('website.name') }}">
                        @error('name')
                        <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="email" class="form-label">{{ __('website.email') }}*</label>
                        <input wire:model.live="email" type="email" id="email" class="form-control"
                               placeholder="user@gmail.com">
                        @error('email')
                        <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="review-form-name">
                        <label for="subject" class="form-label">{{ __('website.subject') }}*</label>
                        <input wire:model.live="subject" type="text" id="subject" class="form-control"
                               placeholder="{{ __('website.subject') }}">
                        @error('subject')
                        <strong class="text-danger" role="alert">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>
                <div class="review-textarea">
                    <label for="floatingTextarea">{{ __('website.message') }}*</label>
                    <textarea wire:model.live="message" class="form-control" placeholder="{{ __('website.write_message') }}..........."
                              id="floatingTextarea" rows="3"></textarea>
                    @error('message')
                    <strong class="text-danger" role="alert">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="login-btn">
                    <button type="submit" class="shop-btn">{{ __('website.send') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>

