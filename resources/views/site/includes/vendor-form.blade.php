<section class="contactUs py-5">
    <div class="container-fluid">
      <!-- contact form -->
      <div class="contact-form bg-white shadow p-4 p-md-5">
        <div class="text-center mb-4">
          <h5 class="fw-bold main text-center fs-3">@lang('site.register as vendor')</h5>
          <p class="text-muted mt-3">
            @lang('site.form text')
          </p>
        </div>
        <form id="userForm" enctype="multipart/form-data">
            @csrf
          <div class="row g-4">
            <div class="col-lg-6">
                <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="full_name"
                  placeholder="@lang('site.name')"
                  required name="full_name" 
                />
                <label for="full_name">@lang('site.name')<span class="text-danger">*</span></label>
              </div>
                <span class="error-message" id="error-full_name"></span>
            </div>
            <div class="col-lg-6">
                <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="shipping_address"
                  placeholder="@lang('site.shipping_address')"
                  required name="shipping_address"
                />
                <label for="shipping_address">@lang('site.shipping_address')<span class="text-danger">*</span></label>
              </div>
                <span class="error-message" id="error-shipping_address"></span>
            </div>
            <div class="col-lg-6">
                <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="brand_name"
                  placeholder="@lang('site.brand_name')"
                  required name="brand_name"
                  />
                  <label for="brand_name">@lang('site.brand_name')<span class="text-danger">*</span></label>
                </div>
                <span class="error-message" id="error-brand_name"></span>
            </div>
            <div class="col-lg-6">
                <div class="form-floating">
                <input
                  type="number" min="1"
                  class="form-control"
                  id="commercial_registration_no"
                  placeholder="@lang('site.commercial_registration_no')"
                 name="commercial_registration_no"
                />
                <label for="commercial_registration_no">@lang('site.commercial_registration_no')</label>
              </div>
                <span class="error-message" id="error-commercial_registration_no"></span>
            </div>
            <div class="col-lg-6">
                <div class="form-floating">
                  <div class="file-input form-control">
                    <input
                    type="file"
                    accept="image/*, .pdf, .doc, .docx, .xls, .xlsx,.txt"
                    class="form-control"
                    id="commercial_registration_image"
                    placeholder="@lang('site.commercial_registration_image')"
                   name="commercial_registration_image"
                  />
                  <span class="label" data-js-label="">@lang('site.commercial_registration_image text')
                  </span>
                </div>
                <label for="commercial_registration_image">
                  <i class="bi bi-paperclip"></i>
                  @lang('site.commercial_registration_image')
                </label>
              </div>
                <span class="error-message" id="error-commercial_registration_image"></span>
            </div>
            
            <!--start hash -->
            {{--<div class="col-lg-6">
              <div class="form-floating">
                <input
                  type="number" min="1"
                  class="form-control"
                  id="tax_no"
                  placeholder="@lang('site.tax_no')"
                 name="tax_no"
                />
                <label for="tax_no">@lang('site.tax_no')</label>
                <span class="error-message" id="error-tax_no"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating">
                <div class="file-input form-control">
                  <input
                    type="file"
                    accept="image/*, .pdf, .doc, .docx, .xls, .xlsx,.txt"
                    class="form-control"
                    id="tax_image"
                    placeholder="@lang('site.tax_image')"
                    multiple
                   name="tax_image[]"
                  />
                  <span class="label" data-js-label="">@lang('site.tax_image text')
                  </span>
                </div>
                <label for="tax_image"><i class="bi bi-paperclip"></i> @lang('site.tax_image')</label>
                <span class="error-message" id="error-tax_image"></span>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="bank_account_no" minlength="10" maxlength="20"
                  placeholder="@lang('site.bank_account_no')"
                   name="bank_account_no"
                />
                <label for="bank_account_no">@lang('site.bank_account_no')</label>
                <span class="error-message" id="error-bank_account_no"></span>
              </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group border">
                    <div class="form-floating">
                <input
                  type="text"
                  class="form-control" maxlength="10"
                  id="vodafone_cash_mobile" maxlength="10"
                  placeholder="@lang('site.vodafone_cash_mobile')"
                   name="vodafone_cash_mobile"
                />
                <label for="vodafone_cash_mobile">@lang('site.vodafone_cash_mobile')</label>
                <span class="error-message" id="error-vodafone_cash_mobile"></span>
              </div>
                    
                    <span class="input-group-text bg-white main fs-5">
                        +20
                    </span>
                </div>
            </div>--}}
            <!--end hash-->
            
            
            <div class="col-lg-6">
                <div class="input-group border">
                    <div class="form-floating">
                        <input
                          type="text"
                          class="form-control"
                          id="mobile" maxlength="10"
                          placeholder="@lang('site.mobile')"
                          required name="mobile"
                        />
                        <label for="mobile">@lang('site.mobile')<span class="text-danger">*</span></label>
                    </div>
                    <span class="input-group-text bg-white main fs-5">
                      +20
                    </span>
                </div>
                <span class="error-message" id="error-mobile"></span>
            </div>
            
            <!--start hash -->
            {{--<div class="col-lg-6">
                <div class="input-group border">
                    <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="another_mobile" maxlength="10"
                  placeholder="@lang('site.another_mobile')"
                 name="another_mobile"
                />
                <label for="another_mobile">@lang('site.another_mobile')</label>
                <span class="error-message" id="error-another_mobile"></span>
              </div>
                    <span class="input-group-text bg-white main fs-5">
                      +20
                    </span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group border">
                    <div class="form-floating">
                <input
                  type="text"
                  class="form-control"
                  id="connected_mobile" maxlength="10"
                  placeholder="@lang('site.connected_mobile')"
                  required name="connected_mobile"
                />
                <label for="connected_mobile">@lang('site.connected_mobile')<span class="text-danger">*</span></label>
                <span class="error-message" id="error-connected_mobile"></span>
              </div>
                    <span class="input-group-text bg-white main fs-5">
                      +20
                    </span>
                </div>
            </div>--}}
            <!--end hash-->
            
            
            <div class="col-lg-6">
                <div class="form-floating">
                <input
                type="email"
                  class="form-control"
                  id="email"
                  placeholder="@lang('site.email')"
                  required name="email"
                  />
                <label for="email">@lang('site.email')<span class="text-danger">*</span></label>
              </div>
                <span class="error-message" id="error-email"></span>
            </div>
            
          </div>
          <!-- ارسال -->
            <button id="loadingIndicator" class="btn main-btn mt-4 mx-auto px-5 py-2" type="submit">
              <span class="spinner-border spinner-border-sm" aria-hidden="true"  style="display: none;"></span>
              <span role="status">
                  @lang('site.send')
              </span>
            </button>
        </form>
      </div>
        <div id="responseMessage" style="margin-top: 20px; color: green;"></div>
    </div>
</section>