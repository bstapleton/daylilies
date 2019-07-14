@extends('layout.order-form')

<img src="{{asset('images/form-header.png')}}" width="400" height="185" alt="A La Carte Daylilies order form" class="c-printTable__logo" />
<table class="c-printTable">
    <thead>
    <tr>
        <th class="c-printTable__quantity c-printTable__heading">Quantity</th>
        <th class="c-printTable__plantChoice c-printTable__heading">First choice</th>
        <th class="c-printTable__plantChoice c-printTable__heading">Second choice</th>
        <th class="c-printTable__price c-printTable__heading">Price Each</th>
        <th class="c-printTable__total c-printTable__heading">Total</th>
    </tr>
    </thead>
    <tbody>
    @for ($i = 0; $i < 15; $i++)
        <tr>
            <td class="c-printTable__quantity c-printTable__cell">&nbsp;</td>
            <td class="c-printTable__plantChoice c-printTable__cell">&nbsp;</td>
            <td class="c-printTable__plantChoice c-printTable__cell">&nbsp;</td>
            <td class="c-printTable__price c-printTable__cell">&nbsp;</td>
            <td class="c-printTable__total c-printTable__cell">&nbsp;</td>
        </tr>
    @endfor
    </tbody>
    <tfoot>
    <tr>
        <td class="c-printTable__cell c-printTable__footerCell" colspan="3" rowspan="2"></td>
        <td class="c-printTable__total c-printTable__cell h-textAlign--right">Postage / Packing</td>
        <td class="c-printTable__total c-printTable__cell">&nbsp;</td>
    </tr>
    <tr>
        <td class="c-printTable__total c-printTable__cell h-textAlign--right">Total</td>
        <td class="c-printTable__total c-printTable__cell">&nbsp;</td>
    </tr>
    </tfoot>
</table>

<div class="l-orderForm__footer">
    <div class="c-card c-card--light h-text--larger">
        <p>Please write address clearly in CAPITALS as this will be used as the label on the parcel.</p>
        <p>Name:</p>
        <p>Address:<br /><br /></p>
        <p>Town:</p>
        <p>County:</p>
        <p>Postcode:</p>
        <p>Email:</p>
    </div>
    <div class="c-card c-card--light h-margin-left__double h-text--larger">
        <p><strong>P&amp;P</strong>:<br />
            1-5 plants &pound;4<br />
            6-10 plants &pound;7<br />
            additional plants add 50p per plant</p>
        <p><strong>Note</strong>:- Orders taken at any time, but plants are dispatched April, May, September &amp; October.</p>
        <p>Payment to be made by cheque or postal order</p>
        <p>Please make payable to:-</p>
        <p class="h-textAlign--center h-text--largest h-text--bold">&quot;A La Carte Daylilies&quot;</p>
    </div>
</div>
