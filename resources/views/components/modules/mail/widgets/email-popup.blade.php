@props(['closeBtn'])
<div class="card mb-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-3">
                <svg  class="icon-20" width="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M19.9926 18.9532H14.2983C13.7427 18.9532 13.2909 19.4123 13.2909 19.9766C13.2909 20.5421 13.7427 21 14.2983 21H19.9926C20.5481 21 21 20.5421 21 19.9766C21 19.4123 20.5481 18.9532 19.9926 18.9532Z" fill="currentColor"/>
                    <path d="M10.309 6.90388L15.7049 11.264C15.835 11.3682 15.8573 11.5596 15.7557 11.6929L9.35874 20.0282C8.95662 20.5431 8.36402 20.8345 7.72908 20.8452L4.23696 20.8882C4.05071 20.8904 3.88775 20.7614 3.84542 20.5765L3.05175 17.1258C2.91419 16.4916 3.05175 15.8358 3.45388 15.3306L9.88256 6.95548C9.98627 6.82111 10.1778 6.79746 10.309 6.90388Z" fill="currentColor"/>
                    <path opacity="0.4" d="M18.1206 8.66544L17.0804 9.96401C16.9756 10.0962 16.7872 10.1177 16.6571 10.0124C15.3925 8.98901 12.1544 6.36285 11.2559 5.63509C11.1247 5.52759 11.1067 5.33625 11.2125 5.20295L12.2157 3.95706C13.1258 2.78534 14.7131 2.67784 15.9936 3.69906L17.4645 4.87078C18.0677 5.34377 18.4698 5.96726 18.6074 6.62299C18.7661 7.3443 18.5968 8.0527 18.1206 8.66544Z" fill="currentColor"/>
                </svg>
                <h5 class="text-primary card-title ms-3 mb-0">Compose Message</h5>
            </div>
            @if ($closeBtn ?? '')
                <div>
                    <button type="button" class="{{$closeBtn ?? ''}}" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <form class="email-form">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">To:</label>
                <div class="col-sm-10">
                    <select class="form-control choices-multiple-remove-button"  multiple >
                        <option value="Barb Dwyer">Barb Dwyer</option>
                        <option value="Brock Lee">Brock Lee</option>
                        <option value="Rick O'Shea">Rick O'Shea</option>
                        <option value="Cliff Hanger">Cliff Hanger</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Cc:</label>
                <div class="col-sm-10">
                    <select class="form-control choices-multiple-remove-button"  multiple >
                        <option value="Barb Dwyer">Barb Dwyer</option>
                        <option value="Brock Lee">Brock Lee</option>
                        <option value="Rick O'Shea">Rick O'Shea</option>
                        <option value="Cliff Hanger">Cliff Hanger</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
                <div class="col-sm-10">
                    <input type="text"  id="subject" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="subject" class="col-sm-2 col-form-label">Your Message:</label>
                <div class="col-md-10">
                    <textarea class="textarea form-control" rows="5">Next, use our Get Started docs to setup Tiny!</textarea>
                </div>
            </div>
            <div class="form-group d-flex flex-wrap align-items-center justify-content-between mb-0">
                <div class="d-flex flex-wrap flex-grow-1 align-items-center">
                    <div class="send-btn pl-3">
                        <a role="button" class="btn btn-primary" href="javascript:void(0)">Send</a>
                    </div>
                    <div class="send-panel">
                        <a class="btn btn-icon btn-primary ms-2" href="javascript:void(0)">
                            <span class="d-flex justify-content-center align-items-center">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="8.25" stroke="currentColor" stroke-width="1.5"/>
                                <path d="M6.91211 14.1738C6.91211 14.1738 8.47733 17.0869 11.9991 17.0869C15.5208 17.0869 17.086 14.1738 17.086 14.1738" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <circle cx="8.47733" cy="9.26102" r="1.56522" fill="currentColor"/>
                                <circle cx="15.5222" cy="9.26102" r="1.56522" fill="currentColor"/>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-icon btn-primary" href="javascript:void(0)">
                            <span class="d-flex justify-content-center align-items-center">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 10L6 20L3 15L9 5L12 10Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 15H21L18 20H6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15 15L9 5H15L21 15H15Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-icon btn-primary" href="javascript:void(0)">
                            <span class="d-flex justify-content-center align-items-center">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0402 4.05132C16.0502 4.45332 16.3592 5.85332 16.7722 6.30332C17.1852 6.75332 17.7762 6.90632 18.1032 6.90632C19.8412 6.90632 21.2502 8.31532 21.2502 10.0523V15.8473C21.2502 18.1773 19.3602 20.0673 17.0302 20.0673H6.9702C4.6392 20.0673 2.7502 18.1773 2.7502 15.8473V10.0523C2.7502 8.31532 4.1592 6.90632 5.8972 6.90632C6.2232 6.90632 6.8142 6.75332 7.2282 6.30332C7.6412 5.85332 7.9492 4.45332 8.9592 4.05132C9.9702 3.64932 14.0302 3.64932 15.0402 4.05132Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.4955 9.5H17.5045" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M15.1789 13.128C15.1789 11.372 13.7559 9.94904 11.9999 9.94904C10.2439 9.94904 8.8209 11.372 8.8209 13.128C8.8209 14.884 10.2439 16.307 11.9999 16.307C13.7559 16.307 15.1789 14.884 15.1789 13.128Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-icon btn-primary" href="javascript:void(0)">
                            <span class="d-flex justify-content-center align-items-center">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8066 7.62355L20.1842 6.54346C19.6576 5.62954 18.4907 5.31426 17.5755 5.83866V5.83866C17.1399 6.09528 16.6201 6.16809 16.1307 6.04103C15.6413 5.91396 15.2226 5.59746 14.9668 5.16131C14.8023 4.88409 14.7139 4.56833 14.7105 4.24598V4.24598C14.7254 3.72916 14.5304 3.22834 14.17 2.85761C13.8096 2.48688 13.3145 2.2778 12.7975 2.27802H11.5435C11.0369 2.27801 10.5513 2.47985 10.194 2.83888C9.83666 3.19791 9.63714 3.68453 9.63958 4.19106V4.19106C9.62457 5.23686 8.77245 6.07675 7.72654 6.07664C7.40418 6.07329 7.08843 5.98488 6.8112 5.82035V5.82035C5.89603 5.29595 4.72908 5.61123 4.20251 6.52516L3.53432 7.62355C3.00838 8.53633 3.31937 9.70255 4.22997 10.2322V10.2322C4.82187 10.574 5.1865 11.2055 5.1865 11.889C5.1865 12.5725 4.82187 13.204 4.22997 13.5457V13.5457C3.32053 14.0719 3.0092 15.2353 3.53432 16.1453V16.1453L4.16589 17.2345C4.41262 17.6797 4.82657 18.0082 5.31616 18.1474C5.80575 18.2865 6.33061 18.2248 6.77459 17.976V17.976C7.21105 17.7213 7.73116 17.6515 8.21931 17.7821C8.70746 17.9128 9.12321 18.233 9.37413 18.6716C9.53867 18.9488 9.62708 19.2646 9.63043 19.5869V19.5869C9.63043 20.6435 10.4869 21.5 11.5435 21.5H12.7975C13.8505 21.5 14.7055 20.6491 14.7105 19.5961V19.5961C14.7081 19.088 14.9088 18.6 15.2681 18.2407C15.6274 17.8814 16.1154 17.6806 16.6236 17.6831C16.9451 17.6917 17.2596 17.7797 17.5389 17.9393V17.9393C18.4517 18.4653 19.6179 18.1543 20.1476 17.2437V17.2437L20.8066 16.1453C21.0617 15.7074 21.1317 15.1859 21.0012 14.6963C20.8706 14.2067 20.5502 13.7893 20.111 13.5366V13.5366C19.6717 13.2839 19.3514 12.8665 19.2208 12.3769C19.0902 11.8872 19.1602 11.3658 19.4153 10.9279C19.5812 10.6383 19.8213 10.3981 20.111 10.2322V10.2322C21.0161 9.70283 21.3264 8.54343 20.8066 7.63271V7.63271V7.62355Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="12.175" cy="11.889" r="2.63616" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-icon btn-primary" href="javascript:void(0)">
                            <span class="d-flex justify-content-center align-items-center">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9995 21C10.801 21 4.5 15.8984 4.5 10.5633C4.5 6.38664 7.8571 3 11.9995 3C16.1419 3 19.5 6.38664 19.5 10.5633C19.5 15.8984 13.198 21 11.9995 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0003 12.9912C9.8426 12.9912 8 13.3174 8 14.6239C8 15.9304 9.83091 16.2684 12.0003 16.2684C14.1579 16.2684 16 15.9416 16 14.6356C16 13.3297 14.1696 12.9912 12.0003 12.9912Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9997 11.1277C13.4156 11.1277 14.5633 9.97954 14.5633 8.56359C14.5633 7.14764 13.4156 6 11.9997 6C10.5837 6 9.43556 7.14764 9.43556 8.56359C9.43078 9.97476 10.571 11.1229 11.9816 11.1277H11.9997Z" stroke="currentColor" stroke-width="1.42857" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="d-flex mr-3 align-items-center mt-2 mt-sm-0">
                    <div class="send-panel float-right">
                        <a class="btn btn-icon btn-primary" href="javascript:void(0)">
                            <span class="d-flex justify-content-center align-items-center">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8066 7.62355L20.1842 6.54346C19.6576 5.62954 18.4907 5.31426 17.5755 5.83866V5.83866C17.1399 6.09528 16.6201 6.16809 16.1307 6.04103C15.6413 5.91396 15.2226 5.59746 14.9668 5.16131C14.8023 4.88409 14.7139 4.56833 14.7105 4.24598V4.24598C14.7254 3.72916 14.5304 3.22834 14.17 2.85761C13.8096 2.48688 13.3145 2.2778 12.7975 2.27802H11.5435C11.0369 2.27801 10.5513 2.47985 10.194 2.83888C9.83666 3.19791 9.63714 3.68453 9.63958 4.19106V4.19106C9.62457 5.23686 8.77245 6.07675 7.72654 6.07664C7.40418 6.07329 7.08843 5.98488 6.8112 5.82035V5.82035C5.89603 5.29595 4.72908 5.61123 4.20251 6.52516L3.53432 7.62355C3.00838 8.53633 3.31937 9.70255 4.22997 10.2322V10.2322C4.82187 10.574 5.1865 11.2055 5.1865 11.889C5.1865 12.5725 4.82187 13.204 4.22997 13.5457V13.5457C3.32053 14.0719 3.0092 15.2353 3.53432 16.1453V16.1453L4.16589 17.2345C4.41262 17.6797 4.82657 18.0082 5.31616 18.1474C5.80575 18.2865 6.33061 18.2248 6.77459 17.976V17.976C7.21105 17.7213 7.73116 17.6515 8.21931 17.7821C8.70746 17.9128 9.12321 18.233 9.37413 18.6716C9.53867 18.9488 9.62708 19.2646 9.63043 19.5869V19.5869C9.63043 20.6435 10.4869 21.5 11.5435 21.5H12.7975C13.8505 21.5 14.7055 20.6491 14.7105 19.5961V19.5961C14.7081 19.088 14.9088 18.6 15.2681 18.2407C15.6274 17.8814 16.1154 17.6806 16.6236 17.6831C16.9451 17.6917 17.2596 17.7797 17.5389 17.9393V17.9393C18.4517 18.4653 19.6179 18.1543 20.1476 17.2437V17.2437L20.8066 16.1453C21.0617 15.7074 21.1317 15.1859 21.0012 14.6963C20.8706 14.2067 20.5502 13.7893 20.111 13.5366V13.5366C19.6717 13.2839 19.3514 12.8665 19.2208 12.3769C19.0902 11.8872 19.1602 11.3658 19.4153 10.9279C19.5812 10.6383 19.8213 10.3981 20.111 10.2322V10.2322C21.0161 9.70283 21.3264 8.54343 20.8066 7.63271V7.63271V7.62355Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <circle cx="12.175" cy="11.889" r="2.63616" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                        <a class="btn btn-icon btn-primary" href="javascript:void(0)">
                            <span class="d-flex justify-content-center align-items-center">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.3249 9.4682C19.3249 9.4682 18.7819 16.2032 18.4669 19.0402C18.3169 20.3952 17.4799 21.1892 16.1089 21.2142C13.4999 21.2612 10.8879 21.2642 8.27991 21.2092C6.96091 21.1822 6.13791 20.3782 5.99091 19.0472C5.67391 16.1852 5.13391 9.4682 5.13391 9.4682" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.7082 6.23969H3.75021" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M17.4406 6.23967C16.6556 6.23967 15.9796 5.68467 15.8256 4.91567L15.5826 3.69967C15.4326 3.13867 14.9246 2.75067 14.3456 2.75067H10.1126C9.53361 2.75067 9.02561 3.13867 8.87561 3.69967L8.63261 4.91567C8.47861 5.68467 7.80261 6.23967 7.01761 6.23967" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
