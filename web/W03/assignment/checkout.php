<?php
// Start session
session_start();


// Data cleaning functions
require_once('./functions.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/styles/main.css">
  <link rel="stylesheet" href="./W03style.css">
</head>
<body>
    <div id="container">
    <header>W03 Assignment</header>
    <h1>Checkout</h1>

    <a href="./shoppingCart.php" class="btn btn-light"></span><i class="fa fa-shopping-cart"></i> View Cart</a>
    
    <form method="POST" action="./confirmation.php">
    <div class="form-grid">
      <label for="address1">Address line 1:</label>
      <input type="text" name="address1" id="address1"></input>
    
      <label for="address1">Address line 2:</label>
      <input type="text" name="address2" id="address2"></input>
    
      <label for="city">City:</label>
      <input type="text" name="city" id="city"></input>

      <label for="country">Country:</label>
      <select id="country" name="country">
          <option name="country" value="AF">Afghanistan</option>
          <option name="country" value="AX">Åland Islands</option>
          <option name="country" value="AL">Albania</option>
          <option name="country" value="DZ">Algeria</option>
          <option name="country" value="AS">American Samoa</option>
          <option name="country" value="AD">Andorra</option>
          <option name="country" value="AO">Angola</option>
          <option name="country" value="AI">Anguilla</option>
          <option name="country" value="AQ">Antarctica</option>
          <option name="country" value="AG">Antigua and Barbuda</option>
          <option name="country" value="AR">Argentina</option>
          <option name="country" value="AM">Armenia</option>
          <option name="country" value="AW">Aruba</option>
          <option name="country" value="AU">Australia</option>
          <option name="country" value="AT">Austria</option>
          <option name="country" value="AZ">Azerbaijan</option>
          <option name="country" value="BS">Bahamas</option>
          <option name="country" value="BH">Bahrain</option>
          <option name="country" value="BD">Bangladesh</option>
          <option name="country" value="BB">Barbados</option>
          <option name="country" value="BY">Belarus</option>
          <option name="country" value="BE">Belgium</option>
          <option name="country" value="BZ">Belize</option>
          <option name="country" value="BJ">Benin</option>
          <option name="country" value="BM">Bermuda</option>
          <option name="country" value="BT">Bhutan</option>
          <option name="country" value="BO">Bolivia, Plurinational State of</option>
          <option name="country" value="BQ">Bonaire, Sint Eustatius and Saba</option>
          <option name="country" value="BA">Bosnia and Herzegovina</option>
          <option name="country" value="BW">Botswana</option>
          <option name="country" value="BV">Bouvet Island</option>
          <option name="country" value="BR">Brazil</option>
          <option name="country" value="IO">British Indian Ocean Territory</option>
          <option name="country" value="BN">Brunei Darussalam</option>
          <option name="country" value="BG">Bulgaria</option>
          <option name="country" value="BF">Burkina Faso</option>
          <option name="country" value="BI">Burundi</option>
          <option name="country" value="KH">Cambodia</option>
          <option name="country" value="CM">Cameroon</option>
          <option name="country" value="CA">Canada</option>
          <option name="country" value="CV">Cape Verde</option>
          <option name="country" value="KY">Cayman Islands</option>
          <option name="country" value="CF">Central African Republic</option>
          <option name="country" value="TD">Chad</option>
          <option name="country" value="CL">Chile</option>
          <option name="country" value="CN">China</option>
          <option name="country" value="CX">Christmas Island</option>
          <option name="country" value="CC">Cocos (Keeling) Islands</option>
          <option name="country" value="CO">Colombia</option>
          <option name="country" value="KM">Comoros</option>
          <option name="country" value="CG">Congo</option>
          <option name="country" value="CD">Congo, the Democratic Republic of the</option>
          <option name="country" value="CK">Cook Islands</option>
          <option name="country" value="CR">Costa Rica</option>
          <option name="country" value="CI">Côte d'Ivoire</option>
          <option name="country" value="HR">Croatia</option>
          <option name="country" value="CU">Cuba</option>
          <option name="country" value="CW">Curaçao</option>
          <option name="country" value="CY">Cyprus</option>
          <option name="country" value="CZ">Czech Republic</option>
          <option name="country" value="DK">Denmark</option>
          <option name="country" value="DJ">Djibouti</option>
          <option name="country" value="DM">Dominica</option>
          <option name="country" value="DO">Dominican Republic</option>
          <option name="country" value="EC">Ecuador</option>
          <option name="country" value="EG">Egypt</option>
          <option name="country" value="SV">El Salvador</option>
          <option name="country" value="GQ">Equatorial Guinea</option>
          <option name="country" value="ER">Eritrea</option>
          <option name="country" value="EE">Estonia</option>
          <option name="country" value="ET">Ethiopia</option>
          <option name="country" value="FK">Falkland Islands (Malvinas)</option>
          <option name="country" value="FO">Faroe Islands</option>
          <option name="country" value="FJ">Fiji</option>
          <option name="country" value="FI">Finland</option>
          <option name="country" value="FR">France</option>
          <option name="country" value="GF">French Guiana</option>
          <option name="country" value="PF">French Polynesia</option>
          <option name="country" value="TF">French Southern Territories</option>
          <option name="country" value="GA">Gabon</option>
          <option name="country" value="GM">Gambia</option>
          <option name="country" value="GE">Georgia</option>
          <option name="country" value="DE">Germany</option>
          <option name="country" value="GH">Ghana</option>
          <option name="country" value="GI">Gibraltar</option>
          <option name="country" value="GR">Greece</option>
          <option name="country" value="GL">Greenland</option>
          <option name="country" value="GD">Grenada</option>
          <option name="country" value="GP">Guadeloupe</option>
          <option name="country" value="GU">Guam</option>
          <option name="country" value="GT">Guatemala</option>
          <option name="country" value="GG">Guernsey</option>
          <option name="country" value="GN">Guinea</option>
          <option name="country" value="GW">Guinea-Bissau</option>
          <option name="country" value="GY">Guyana</option>
          <option name="country" value="HT">Haiti</option>
          <option name="country" value="HM">Heard Island and McDonald Islands</option>
          <option name="country" value="VA">Holy See (Vatican City State)</option>
          <option name="country" value="HN">Honduras</option>
          <option name="country" value="HK">Hong Kong</option>
          <option name="country" value="HU">Hungary</option>
          <option name="country" value="IS">Iceland</option>
          <option name="country" value="IN">India</option>
          <option name="country" value="ID">Indonesia</option>
          <option name="country" value="IR">Iran, Islamic Republic of</option>
          <option name="country" value="IQ">Iraq</option>
          <option name="country" value="IE">Ireland</option>
          <option name="country" value="IM">Isle of Man</option>
          <option name="country" value="IL">Israel</option>
          <option name="country" value="IT">Italy</option>
          <option name="country" value="JM">Jamaica</option>
          <option name="country" value="JP">Japan</option>
          <option name="country" value="JE">Jersey</option>
          <option name="country" value="JO">Jordan</option>
          <option name="country" value="KZ">Kazakhstan</option>
          <option name="country" value="KE">Kenya</option>
          <option name="country" value="KI">Kiribati</option>
          <option name="country" value="KP">Korea, Democratic People's Republic of</option>
          <option name="country" value="KR">Korea, Republic of</option>
          <option name="country" value="KW">Kuwait</option>
          <option name="country" value="KG">Kyrgyzstan</option>
          <option name="country" value="LA">Lao People's Democratic Republic</option>
          <option name="country" value="LV">Latvia</option>
          <option name="country" value="LB">Lebanon</option>
          <option name="country" value="LS">Lesotho</option>
          <option name="country" value="LR">Liberia</option>
          <option name="country" value="LY">Libya</option>
          <option name="country" value="LI">Liechtenstein</option>
          <option name="country" value="LT">Lithuania</option>
          <option name="country" value="LU">Luxembourg</option>
          <option name="country" value="MO">Macao</option>
          <option name="country" value="MK">Macedonia, the former Yugoslav Republic of</option>
          <option name="country" value="MG">Madagascar</option>
          <option name="country" value="MW">Malawi</option>
          <option name="country" value="MY">Malaysia</option>
          <option name="country" value="MV">Maldives</option>
          <option name="country" value="ML">Mali</option>
          <option name="country" value="MT">Malta</option>
          <option name="country" value="MH">Marshall Islands</option>
          <option name="country" value="MQ">Martinique</option>
          <option name="country" value="MR">Mauritania</option>
          <option name="country" value="MU">Mauritius</option>
          <option name="country" value="YT">Mayotte</option>
          <option name="country" value="MX">Mexico</option>
          <option name="country" value="FM">Micronesia, Federated States of</option>
          <option name="country" value="MD">Moldova, Republic of</option>
          <option name="country" value="MC">Monaco</option>
          <option name="country" value="MN">Mongolia</option>
          <option name="country" value="ME">Montenegro</option>
          <option name="country" value="MS">Montserrat</option>
          <option name="country" value="MA">Morocco</option>
          <option name="country" value="MZ">Mozambique</option>
          <option name="country" value="MM">Myanmar</option>
          <option name="country" value="NA">Namibia</option>
          <option name="country" value="NR">Nauru</option>
          <option name="country" value="NP">Nepal</option>
          <option name="country" value="NL">Netherlands</option>
          <option name="country" value="NC">New Caledonia</option>
          <option name="country" value="NZ">New Zealand</option>
          <option name="country" value="NI">Nicaragua</option>
          <option name="country" value="NE">Niger</option>
          <option name="country" value="NG">Nigeria</option>
          <option name="country" value="NU">Niue</option>
          <option name="country" value="NF">Norfolk Island</option>
          <option name="country" value="MP">Northern Mariana Islands</option>
          <option name="country" value="NO">Norway</option>
          <option name="country" value="OM">Oman</option>
          <option name="country" value="PK">Pakistan</option>
          <option name="country" value="PW">Palau</option>
          <option name="country" value="PS">Palestinian Territory, Occupied</option>
          <option name="country" value="PA">Panama</option>
          <option name="country" value="PG">Papua New Guinea</option>
          <option name="country" value="PY">Paraguay</option>
          <option name="country" value="PE">Peru</option>
          <option name="country" value="PH">Philippines</option>
          <option name="country" value="PN">Pitcairn</option>
          <option name="country" value="PL">Poland</option>
          <option name="country" value="PT">Portugal</option>
          <option name="country" value="PR">Puerto Rico</option>
          <option name="country" value="QA">Qatar</option>
          <option name="country" value="RE">Réunion</option>
          <option name="country" value="RO">Romania</option>
          <option name="country" value="RU">Russian Federation</option>
          <option name="country" value="RW">Rwanda</option>
          <option name="country" value="BL">Saint Barthélemy</option>
          <option name="country" value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
          <option name="country" value="KN">Saint Kitts and Nevis</option>
          <option name="country" value="LC">Saint Lucia</option>
          <option name="country" value="MF">Saint Martin (French part)</option>
          <option name="country" value="PM">Saint Pierre and Miquelon</option>
          <option name="country" value="VC">Saint Vincent and the Grenadines</option>
          <option name="country" value="WS">Samoa</option>
          <option name="country" value="SM">San Marino</option>
          <option name="country" value="ST">Sao Tome and Principe</option>
          <option name="country" value="SA">Saudi Arabia</option>
          <option name="country" value="SN">Senegal</option>
          <option name="country" value="RS">Serbia</option>
          <option name="country" value="SC">Seychelles</option>
          <option name="country" value="SL">Sierra Leone</option>
          <option name="country" value="SG">Singapore</option>
          <option name="country" value="SX">Sint Maarten (Dutch part)</option>
          <option name="country" value="SK">Slovakia</option>
          <option name="country" value="SI">Slovenia</option>
          <option name="country" value="SB">Solomon Islands</option>
          <option name="country" value="SO">Somalia</option>
          <option name="country" value="ZA">South Africa</option>
          <option name="country" value="GS">South Georgia and the South Sandwich Islands</option>
          <option name="country" value="SS">South Sudan</option>
          <option name="country" value="ES">Spain</option>
          <option name="country" value="LK">Sri Lanka</option>
          <option name="country" value="SD">Sudan</option>
          <option name="country" value="SR">Suriname</option>
          <option name="country" value="SJ">Svalbard and Jan Mayen</option>
          <option name="country" value="SZ">Swaziland</option>
          <option name="country" value="SE">Sweden</option>
          <option name="country" value="CH">Switzerland</option>
          <option name="country" value="SY">Syrian Arab Republic</option>
          <option name="country" value="TW">Taiwan, Province of China</option>
          <option name="country" value="TJ">Tajikistan</option>
          <option name="country" value="TZ">Tanzania, United Republic of</option>
          <option name="country" value="TH">Thailand</option>
          <option name="country" value="TL">Timor-Leste</option>
          <option name="country" value="TG">Togo</option>
          <option name="country" value="TK">Tokelau</option>
          <option name="country" value="TO">Tonga</option>
          <option name="country" value="TT">Trinidad and Tobago</option>
          <option name="country" value="TN">Tunisia</option>
          <option name="country" value="TR">Turkey</option>
          <option name="country" value="TM">Turkmenistan</option>
          <option name="country" value="TC">Turks and Caicos Islands</option>
          <option name="country" value="TV">Tuvalu</option>
          <option name="country" value="UG">Uganda</option>
          <option name="country" value="UA">Ukraine</option>
          <option name="country" value="AE">United Arab Emirates</option>
          <option name="country" value="GB">United Kingdom</option>
          <option name="country" value="US">United States</option>
          <option name="country" value="UM">United States Minor Outlying Islands</option>
          <option name="country" value="UY">Uruguay</option>
          <option name="country" value="UZ">Uzbekistan</option>
          <option name="country" value="VU">Vanuatu</option>
          <option name="country" value="VE">Venezuela, Bolivarian Republic of</option>
          <option name="country" value="VN">Viet Nam</option>
          <option name="country" value="VG">Virgin Islands, British</option>
          <option name="country" value="VI">Virgin Islands, U.S.</option>
          <option name="country" value="WF">Wallis and Futuna</option>
          <option name="country" value="EH">Western Sahara</option>
          <option name="country" value="YE">Yemen</option>
          <option name="country" value="ZM">Zambia</option>
          <option name="country" value="ZW">Zimbabwe</option>
    </select>

    </div>
    <a id="purchase" class="btn btn-dark highlight">Complete Purchase</a>
    </form>
    
   </div>
    </div>

    <footer>
      <p>&copy; CSE 341 - Rolando Rodriguez</p>
      <a href="/">Return home</a>
    </footer>
    </div>
</body>
<script src="./W03.js"></script>
</html>