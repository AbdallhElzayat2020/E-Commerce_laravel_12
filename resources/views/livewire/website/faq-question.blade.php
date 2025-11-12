<div>
    <div class="question-section login-section " data-aos="fade-left">
        <div class="review-form">
            <h5 class="comment-title">Have Any Question</h5>
            <div class=" account-inner-form">
                <div class="review-form-name">
                    <label for="fname" class="form-label">Name*</label>
                    <input type="text" id="fname" wire:model.live="name" class="form-control" placeholder="Name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="review-form-name">
                    <label for="email" class="form-label">Email*</label>
                    <input type="email" id="email" wire:model.live="email" class="form-control" placeholder="user@gmail.com">
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="review-form-name">
                    <label for="subject" class="form-label">Subject*</label>
                    <input type="text" id="subject" wire:model.live="subject" class="form-control" placeholder="Subject">
                    @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="review-textarea">
                <label for="floatingTextarea">Massage*</label>
                <textarea class="form-control" wire:model.live="message" placeholder="Write Massage..........." id="floatingTextarea"
                          rows="3"></textarea>
                @error('message') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="login-btn">
                <a href="#" class="shop-btn">Send Now</a>
            </div>
        </div>
    </div>
</div>
