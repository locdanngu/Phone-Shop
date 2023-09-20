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
    <div style="display: flex;justify-content:center;margin:3em 0">
        <button class="btnchangeuser active" data-target="container1">List address</button>
        <button class="btnchangeuser" data-target="container2">Information / Add address</button>
        <button class="btnchangeuser" data-target="container3">Change password</button>
    </div>


    <div class="container hidecontainer" id="container2" style="display: none;">
        <div class="row fixcolumn">
            <div class="col-md-5" style="margin:0 0 3em 0">
                <form action="{{ route('changenameuser') }}" class="checkout" method="post" name="checkout">
                    @csrf
                    <div id="customer_details" class="col2-set">
                        <div class="woocommerce-billing-fields">
                            <h3>Personal information</h3>
                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                <label class="" for="billing_first_name">First Name
                                </label>
                                <input type="text" value="{{ $user->firstname }}" placeholder="" id="billing_first_name"
                                    name="firstname" class="input-text" required>
                            </p>
                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                <label class="" for="billing_first_name">Last Name
                                </label>
                                <input type="text" value="{{ $user->lastname }}" placeholder="" id="billing_first_name"
                                    name="lastname" class="input-text" required>
                            </p>
                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                <label class="" for="billing_first_name">Username
                                </label>
                                <input type="text" value="{{ $user->username }}" placeholder="" id="billing_first_name"
                                    name="" class="input-text" disabled>
                            </p>
                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                <label class="" for="billing_first_name">Email
                                </label>
                                <input type="text" value="{{ $user->email }}" placeholder="" id="billing_first_name"
                                    name="" class="input-text" disabled>
                            </p>
                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                <label class="" for="billing_first_name">Phone
                                </label>
                                <input type="text" value="{{ $user->phone }}" placeholder="" id="billing_first_name"
                                    name="" class="input-text" disabled>
                            </p>
                        </div>
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
            <div class="col-md-5">
                <form action="{{ route('addaddress') }}" class="checkout" method="post" name="checkout">
                    @csrf
                    <div id="customer_details" class="col2-set">
                        <div class="">
                            <div class="woocommerce-billing-fields">
                                <h3>Add address</h3>
                                <p id="billing_country_field"
                                    class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                    <label class="" for="billing_country">Country <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <select class="country_to_state country_select" id="billing_country"
                                        name="country">
                                        <option value="AX">Åland Islands</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AD">Andorra</option>
                                        <option value="AO">Angola</option>
                                        <option value="AI">Anguilla</option>
                                        <option value="AQ">Antarctica</option>
                                        <option value="AG">Antigua and Barbuda</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>
                                        <option value="BB">Barbados</option>
                                        <option value="BY">Belarus</option>
                                        <option value="PW">Belau</option>
                                        <option value="BE">Belgium</option>
                                        <option value="BZ">Belize</option>
                                        <option value="BJ">Benin</option>
                                        <option value="BM">Bermuda</option>
                                        <option value="BT">Bhutan</option>
                                        <option value="BO">Bolivia</option>
                                        <option value="BQ">Bonaire, Saint Eustatius and Saba</option>
                                        <option value="BA">Bosnia and Herzegovina</option>
                                        <option value="BW">Botswana</option>
                                        <option value="BV">Bouvet Island</option>
                                        <option value="BR">Brazil</option>
                                        <option value="IO">British Indian Ocean Territory</option>
                                        <option value="VG">British Virgin Islands</option>
                                        <option value="BN">Brunei</option>
                                        <option value="BG">Bulgaria</option>
                                        <option value="BF">Burkina Faso</option>
                                        <option value="BI">Burundi</option>
                                        <option value="KH">Cambodia</option>
                                        <option value="CM">Cameroon</option>
                                        <option value="CA">Canada</option>
                                        <option value="CV">Cape Verde</option>
                                        <option value="KY">Cayman Islands</option>
                                        <option value="CF">Central African Republic</option>
                                        <option value="TD">Chad</option>
                                        <option value="CL">Chile</option>
                                        <option value="CN">China</option>
                                        <option value="CX">Christmas Island</option>
                                        <option value="CC">Cocos (Keeling) Islands</option>
                                        <option value="CO">Colombia</option>
                                        <option value="KM">Comoros</option>
                                        <option value="CG">Congo (Brazzaville)</option>
                                        <option value="CD">Congo (Kinshasa)</option>
                                        <option value="CK">Cook Islands</option>
                                        <option value="CR">Costa Rica</option>
                                        <option value="HR">Croatia</option>
                                        <option value="CU">Cuba</option>
                                        <option value="CW">CuraÇao</option>
                                        <option value="CY">Cyprus</option>
                                        <option value="CZ">Czech Republic</option>
                                        <option value="DK">Denmark</option>
                                        <option value="DJ">Djibouti</option>
                                        <option value="DM">Dominica</option>
                                        <option value="DO">Dominican Republic</option>
                                        <option value="EC">Ecuador</option>
                                        <option value="EG">Egypt</option>
                                        <option value="SV">El Salvador</option>
                                        <option value="GQ">Equatorial Guinea</option>
                                        <option value="ER">Eritrea</option>
                                        <option value="EE">Estonia</option>
                                        <option value="ET">Ethiopia</option>
                                        <option value="FK">Falkland Islands</option>
                                        <option value="FO">Faroe Islands</option>
                                        <option value="FJ">Fiji</option>
                                        <option value="FI">Finland</option>
                                        <option value="FR">France</option>
                                        <option value="GF">French Guiana</option>
                                        <option value="PF">French Polynesia</option>
                                        <option value="TF">French Southern Territories</option>
                                        <option value="GA">Gabon</option>
                                        <option value="GM">Gambia</option>
                                        <option value="GE">Georgia</option>
                                        <option value="DE">Germany</option>
                                        <option value="GH">Ghana</option>
                                        <option value="GI">Gibraltar</option>
                                        <option value="GR">Greece</option>
                                        <option value="GL">Greenland</option>
                                        <option value="GD">Grenada</option>
                                        <option value="GP">Guadeloupe</option>
                                        <option value="GT">Guatemala</option>
                                        <option value="GG">Guernsey</option>
                                        <option value="GN">Guinea</option>
                                        <option value="GW">Guinea-Bissau</option>
                                        <option value="GY">Guyana</option>
                                        <option value="HT">Haiti</option>
                                        <option value="HM">Heard Island and McDonald Islands</option>
                                        <option value="HN">Honduras</option>
                                        <option value="HK">Hong Kong</option>
                                        <option value="HU">Hungary</option>
                                        <option value="IS">Iceland</option>
                                        <option value="IN">India</option>
                                        <option value="ID">Indonesia</option>
                                        <option value="IR">Iran</option>
                                        <option value="IQ">Iraq</option>
                                        <option value="IM">Isle of Man</option>
                                        <option value="IL">Israel</option>
                                        <option value="IT">Italy</option>
                                        <option value="CI">Ivory Coast</option>
                                        <option value="JM">Jamaica</option>
                                        <option value="JP">Japan</option>
                                        <option value="JE">Jersey</option>
                                        <option value="JO">Jordan</option>
                                        <option value="KZ">Kazakhstan</option>
                                        <option value="KE">Kenya</option>
                                        <option value="KI">Kiribati</option>
                                        <option value="KW">Kuwait</option>
                                        <option value="KG">Kyrgyzstan</option>
                                        <option value="LA">Laos</option>
                                        <option value="LV">Latvia</option>
                                        <option value="LB">Lebanon</option>
                                        <option value="LS">Lesotho</option>
                                        <option value="LR">Liberia</option>
                                        <option value="LY">Libya</option>
                                        <option value="LI">Liechtenstein</option>
                                        <option value="LT">Lithuania</option>
                                        <option value="LU">Luxembourg</option>
                                        <option value="MO">Macao S.A.R., China</option>
                                        <option value="MK">Macedonia</option>
                                        <option value="MG">Madagascar</option>
                                        <option value="MW">Malawi</option>
                                        <option value="MY">Malaysia</option>
                                        <option value="MV">Maldives</option>
                                        <option value="ML">Mali</option>
                                        <option value="MT">Malta</option>
                                        <option value="MH">Marshall Islands</option>
                                        <option value="MQ">Martinique</option>
                                        <option value="MR">Mauritania</option>
                                        <option value="MU">Mauritius</option>
                                        <option value="YT">Mayotte</option>
                                        <option value="MX">Mexico</option>
                                        <option value="FM">Micronesia</option>
                                        <option value="MD">Moldova</option>
                                        <option value="MC">Monaco</option>
                                        <option value="MN">Mongolia</option>
                                        <option value="ME">Montenegro</option>
                                        <option value="MS">Montserrat</option>
                                        <option value="MA">Morocco</option>
                                        <option value="MZ">Mozambique</option>
                                        <option value="MM">Myanmar</option>
                                        <option value="NA">Namibia</option>
                                        <option value="NR">Nauru</option>
                                        <option value="NP">Nepal</option>
                                        <option value="NL">Netherlands</option>
                                        <option value="AN">Netherlands Antilles</option>
                                        <option value="NC">New Caledonia</option>
                                        <option value="NZ">New Zealand</option>
                                        <option value="NI">Nicaragua</option>
                                        <option value="NE">Niger</option>
                                        <option value="NG">Nigeria</option>
                                        <option value="NU">Niue</option>
                                        <option value="NF">Norfolk Island</option>
                                        <option value="KP">North Korea</option>
                                        <option value="NO">Norway</option>
                                        <option value="OM">Oman</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="PS">Palestinian Territory</option>
                                        <option value="PA">Panama</option>
                                        <option value="PG">Papua New Guinea</option>
                                        <option value="PY">Paraguay</option>
                                        <option value="PE">Peru</option>
                                        <option value="PH">Philippines</option>
                                        <option value="PN">Pitcairn</option>
                                        <option value="PL">Poland</option>
                                        <option value="PT">Portugal</option>
                                        <option value="QA">Qatar</option>
                                        <option value="IE">Republic of Ireland</option>
                                        <option value="RE">Reunion</option>
                                        <option value="RO">Romania</option>
                                        <option value="RU">Russia</option>
                                        <option value="RW">Rwanda</option>
                                        <option value="ST">São Tomé and Príncipe</option>
                                        <option value="BL">Saint Barthélemy</option>
                                        <option value="SH">Saint Helena</option>
                                        <option value="KN">Saint Kitts and Nevis</option>
                                        <option value="LC">Saint Lucia</option>
                                        <option value="SX">Saint Martin (Dutch part)</option>
                                        <option value="MF">Saint Martin (French part)</option>
                                        <option value="PM">Saint Pierre and Miquelon</option>
                                        <option value="VC">Saint Vincent and the Grenadines</option>
                                        <option value="SM">San Marino</option>
                                        <option value="SA">Saudi Arabia</option>
                                        <option value="SN">Senegal</option>
                                        <option value="RS">Serbia</option>
                                        <option value="SC">Seychelles</option>
                                        <option value="SL">Sierra Leone</option>
                                        <option value="SG">Singapore</option>
                                        <option value="SK">Slovakia</option>
                                        <option value="SI">Slovenia</option>
                                        <option value="SB">Solomon Islands</option>
                                        <option value="SO">Somalia</option>
                                        <option value="ZA">South Africa</option>
                                        <option value="GS">South Georgia/Sandwich Islands</option>
                                        <option value="KR">South Korea</option>
                                        <option value="SS">South Sudan</option>
                                        <option value="ES">Spain</option>
                                        <option value="LK">Sri Lanka</option>
                                        <option value="SD">Sudan</option>
                                        <option value="SR">Suriname</option>
                                        <option value="SJ">Svalbard and Jan Mayen</option>
                                        <option value="SZ">Swaziland</option>
                                        <option value="SE">Sweden</option>
                                        <option value="CH">Switzerland</option>
                                        <option value="SY">Syria</option>
                                        <option value="TW">Taiwan</option>
                                        <option value="TJ">Tajikistan</option>
                                        <option value="TZ">Tanzania</option>
                                        <option value="TH">Thailand</option>
                                        <option value="TL">Timor-Leste</option>
                                        <option value="TG">Togo</option>
                                        <option value="TK">Tokelau</option>
                                        <option value="TO">Tonga</option>
                                        <option value="TT">Trinidad and Tobago</option>
                                        <option value="TN">Tunisia</option>
                                        <option value="TR">Turkey</option>
                                        <option value="TM">Turkmenistan</option>
                                        <option value="TC">Turks and Caicos Islands</option>
                                        <option value="TV">Tuvalu</option>
                                        <option value="UG">Uganda</option>
                                        <option value="UA">Ukraine</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option selected="selected" value="GB">United Kingdom (UK)</option>
                                        <option value="US">United States (US)</option>
                                        <option value="UY">Uruguay</option>
                                        <option value="UZ">Uzbekistan</option>
                                        <option value="VU">Vanuatu</option>
                                        <option value="VA">Vatican</option>
                                        <option value="VE">Venezuela</option>
                                        <option value="VN">Vietnam</option>
                                        <option value="WF">Wallis and Futuna</option>
                                        <option value="EH">Western Sahara</option>
                                        <option value="WS">Western Samoa</option>
                                        <option value="YE">Yemen</option>
                                        <option value="ZM">Zambia</option>
                                        <option value="ZW">Zimbabwe</option>
                                    </select>
                                </p>
                                <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                    <label class="" for="billing_first_name">Town / City <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="" placeholder="" id="billing_first_name"
                                        name="town_city" class="input-text " required>
                                </p>
                                <p id="billing_state_field" class="form-row form-row-first address-field validate-state"
                                    data-o_class="form-row form-row-first address-field validate-state">
                                    <label class="" for="billing_state">County</label>
                                    <input type="text" id="billing_state" name="state_country"
                                        placeholder="State / County" value="" class="input-text">
                                </p>
                                <p id="billing_address_1_field"
                                    class="form-row form-row-wide address-field validate-required">
                                    <label class="" for="billing_address_1">Address <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="" placeholder="Street address" id="billing_address_1"
                                        name="address" class="input-text " required>
                                </p>
                                <p id="billing_address_2_field" class="form-row form-row-wide address-field">
                                    <input type="text" value="" placeholder="Apartment, suite, unit etc. (optional)"
                                        id="apartment" name="apartment" class="input-text ">
                                </p>
                                <p id="billing_company_field" class="form-row form-row-wide">
                                    <label class="" for="billing_company">Company Name</label>
                                    <input type="text" value="" placeholder="" id="billing_company"
                                        name="companyname" class="input-text ">
                                </p>
                                <p id="billing_postcode_field"
                                    class="form-row form-row-last address-field validate-required validate-postcode"
                                    data-o_class="form-row form-row-last address-field validate-required validate-postcode">
                                    <label class="" for="billing_postcode">Postcode <abbr title="required"
                                            class="required">*</abbr>
                                    </label>
                                    <input type="text" value="" placeholder="Postcode / Zip" id="billing_postcode"
                                        name="postcode" class="input-text" required>
                                </p>
                                <p id="order_comments_field" class="form-row notes">
                                    <label class="" for="order_comments">Order Notes</label>
                                    <textarea cols="5" rows="2"
                                        placeholder="Notes about your order, e.g. special notes for delivery."
                                        id="order_comments" class="input-text " name="ordernote"></textarea>
                                </p>
                            </div>
                        </div>
                        <input type="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container hidecontainer" id="container1">
        <div class="card-body table-responsive p-0">
            <div class="d-flex flex-column justify-content-between">
                <table cellspacing="0" class="shop_table cart table text-nowrap">
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">State contry</th>
                            <th class="product-name">Contry</th>
                            <th class="product-price">Town city</th>
                            <th class="product-quantity">Address</th>
                            <th class="product-subtotal">company name</th>
                            <th class="product-subtotal">Post code</th>
                            <th class="product-subtotal">Apartment</th>
                            <th class="product-subtotal">Order note</th>
                        </tr>
                    </thead>
                    <tbody id="capnhatdanhsachdiachi">
                        @if($user->postcode != null)
                        <tr class="cart_item" data-product-id="">
                            <td class="product-remove">
                                <a title="Remove this item" class="remove" href="#" type="button" data-toggle="modal"
                                    data-target="#modal-deleteproduct" data-id="" data-name="">×</a>
                            </td>

                            <td class="product-thumbnail">
                                <span class="amount">{{ $user->state_country }}</span>
                            </td>

                            <td class="product-name">
                                <span class="amount">{{ $user->country }}</span>
                            </td>

                            <td class="product-price">
                                <span class="amount">{{ $user->town_city }}</span>
                            </td>

                            <td class="product-price">
                                <span class="amount">{{ $user->address }}</span>
                            </td>

                            <td class="product-price">
                                <span class="amount">{{ $user->companyname }}</span>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{ $user->postcode }}</span>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{ $user->apartment }}</span>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{ $user->ordernote }}</span>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan=9 style="text-align:center; font-weight:bold">You do not have a delivery address
                            </td>
                        </tr>
                        @endif
                        @if(count($listaddress))
                        @foreach($listaddress as $la)
                        <tr class="cart_item" data-product-id="">
                            <td class="product-remove">
                                <a title="Remove this item" class="remove" href="#" type="button" data-toggle="modal"
                                    data-target="#modal-deleteproduct" data-id="" data-name="">×</a>
                            </td>

                            <td class="product-thumbnail">
                                <span class="amount">{{ $la->state_country }}</span>
                            </td>

                            <td class="product-name">
                                <span class="amount">{{ $la->country }}</span>
                            </td>

                            <td class="product-price">
                                <span class="amount">{{ $la->town_city }}</span>
                            </td>

                            <td class="product-price">
                                <span class="amount">{{ $la->address }}</span>
                            </td>

                            <td class="product-price">
                                <span class="amount">{{ $la->companyname }}</span>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{ $la->postcode }}</span>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{ $la->apartment }}</span>
                            </td>
                            <td class="product-price">
                                <span class="amount">{{ $la->ordernote }}</span>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container hidecontainer" id="container3" style="display: none;">

    </div>
</div>
@endsection


@section('popup')


@endsection

@section('js')
<script>
$(document).ready(function() {
    // Gán sự kiện click cho các nút
    $('.btnchangeuser').click(function() {
        // Loại bỏ lớp 'active' từ tất cả các nút
        $('.btnchangeuser').removeClass('active');

        // Thêm lớp 'active' cho nút được nhấp
        $(this).addClass('active');

        // Lấy giá trị của thuộc tính data-target từ nút được nhấp
        var target = $(this).data('target');

        // Ẩn tất cả các container trước khi hiển thị container cần thiết
        $('.hidecontainer').hide();

        // Hiển thị container được chọn
        $('#' + target).show();
    });

});
</script>
@endsection