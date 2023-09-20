@extends('user.layouts.Userlayout')

@section('title', 'User page')

@section('body')
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>User</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->


<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form enctype="multipart/form-data" action="#" class="checkout" method="post" name="checkout">

                    <div id="customer_details" class="col2-set">
                        <div class="col-1">
                            <div class="woocommerce-billing-fields">
                                <h3>Personal information</h3>
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">First Name <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="{{ $user->firstname }}" placeholder=""
                                        id="billing_first_name" name="billing_first_name" class="input-text ">
                                </p>
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Last Name <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="{{ $user->lastname }}" placeholder=""
                                        id="billing_first_name" name="billing_first_name" class="input-text ">
                                </p>
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Username <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="{{ $user->username }}" placeholder=""
                                        id="billing_first_name" name="billing_first_name" class="input-text" disabled>
                                </p>
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Email <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="{{ $user->email }}" placeholder=""
                                        id="billing_first_name" name="billing_first_name" class="input-text" disabled>
                                </p>
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Phone <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="{{ $user->phone }}" placeholder=""
                                        id="billing_first_name" name="billing_first_name" class="input-text" disabled>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('popup')


@endsection

@section('js')
<script>

</script>
@endsection