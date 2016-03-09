@extends('layouts.master')

@section('content')
<h1>Gang!</h1>
<div class="invitation">
    <p>
        On <i>Sunday April 10</i> I'll be hosting a pool party at my parent's weekend house!.<br>
        I already bought some beers and food, we are going to play soccer, have fun, and many other surprises.<br>
        The house is located at 'General Lagos', close to 'Pueblo Esther'.<br>
        You will found driving directions at the end of this page.<br>
        Everyone will be waiting for you!!!
    </p>
    <p align="right">[Gaita]</p>
</div>
<a href="/crew">The crew</a><br><br><br>
<div id="center-sw"></div>
<table class="main-table">
    <thead>
        <tr><th colspan="2">Let's go {{ $guest->name }}!</th></tr>
    </thead>
    <tbody>
        <tr id="going-tr">
            <td>Are you coming?</td>
            <td>
                <input type="checkbox"
                    data-on-text="YES" data-size="large"
                    data-off-text="NO"
                    name="going-switch"
                    {{ $guest->going ? 'checked' : '' }}
                >
            </td>
        </tr>
        <tr id="needaride-tr">
            <td>Need a ride?</td>
            <td>
                <input type="checkbox"
                    data-on-text="YES"
                    data-size="large"
                    data-off-text="NO"
                    name="needaride-switch"
                    {{ $guest->need_a_ride ? 'checked' : '' }}
                >
            </td>
        </tr>
        <tr>
            <td colspan="2" id="comment-td">Comments</td>
        </tr>
        <tr class="odd">
            <td colspan="2" style="padding-top: 0px;">
                <textarea rows="4"
                    type="text"
                    maxlength="255"
                    data-guestid="{{ $guest->id }}"
                    data-guesttoken="{{ $guest->token }}"
                    data-csrftoken="{{ csrf_token() }}"
                    id="comment-textarea"
                    placeholder="{{ $guest->comment or 'Algo para decir?...' }}"
                ></textarea>
                <span class="input-group-btn">
                    <button class="btn btn-default" id="comment-button" type="button">
                        Submit Comment
                    </button>
                </span>
            </td>
        </tr>
        <tr>
            <td colspan="2" id="messages-td">
                <div id="msg-going" {!! $guest->going ? '' : 'class="no-display"' !!}>
                    Nice {{ $guest->name }}, you are in!
                </div>
                <div id="msg-not-going" {!! $guest->going ? 'class="no-display"' : '' !!}>
                    You didn't confirmed attendance yet.
                </div>
            </td>
        </tr>
    </tbody>
</table>
<br>
<a href="/guestslist" target="_blank">Take a look to the party guestslist!</a><br><br>
<a href="/howtoget" >How to get there?</a><br><br><br>
@endsection
