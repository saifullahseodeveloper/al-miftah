/* NekNeev Complete System — Frontend JS */
(function($){

    // ── Password Toggle ──────────────────────────────────────────────────────
    window.nkTogglePass = function() {
        var inp = document.getElementById('nk-pass');
        if (!inp) return;
        inp.type = inp.type === 'password' ? 'text' : 'password';
    };

    // ── Password Strength ────────────────────────────────────────────────────
    var passInp = document.getElementById('nk-pass');
    if (passInp) {
        passInp.addEventListener('input', function(){
            var v = this.value, bar = document.getElementById('nk-pass-strength');
            if (!bar) return;
            var score = 0;
            if (v.length >= 8)  score++;
            if (/[A-Z]/.test(v)) score++;
            if (/[0-9]/.test(v)) score++;
            if (/[^A-Za-z0-9]/.test(v)) score++;
            var colors = ['#e56b6f','#d4a017','#52b788','#1b4332'];
            var widths  = ['25%','50%','75%','100%'];
            bar.style.background = colors[score-1] || '#e9e9e9';
            bar.style.width      = score > 0 ? widths[score-1] : '0%';
        });
    }

    // ── OTP Functions ────────────────────────────────────────────────────────
    window.nkSendOtp = function() {
        var mobile = document.getElementById('nk-mobile').value.trim();
        var msg    = document.getElementById('nk-otp-msg');
        if (mobile.length !== 10 || isNaN(mobile)) {
            msg.style.color = '#e56b6f';
            msg.innerText   = '⚠ Sahi 10 digit mobile number daalo';
            return;
        }
        msg.style.color = '#40916c';
        msg.innerText   = '⏳ OTP bheja ja raha hai...';

        $.post(NEKNAV.ajax_url, {
            action: 'neknav_send_otp',
            nonce:  NEKNAV.nonce,
            mobile: mobile
        }, function(res) {
            if (res.success) {
                document.getElementById('nk-otp-step1').style.display = 'none';
                document.getElementById('nk-otp-step2').style.display = 'block';

                // Test mode: show OTP on screen
                if (res.data && res.data.test_otp) {
                    var testDiv = document.getElementById('nk-test-otp');
                    testDiv.style.display = 'block';
                    testDiv.innerHTML = '🧪 TEST MODE — Aapka OTP: <strong style="font-size:20px;letter-spacing:4px">' + res.data.test_otp + '</strong><br><small>Real SMS nahi gaya. SMS settings mein Test Mode OFF karo.</small>';
                } else {
                    document.getElementById('nk-otp-msg').innerText = '✅ OTP bhej diya gaya! ' + mobile + ' check karein.';
                }
            } else {
                msg.style.color = '#e56b6f';
                msg.innerText   = '⚠ ' + (res.data || 'OTP nahi bheja ja saka');
            }
        });
    };

    window.nkVerifyOtp = function() {
        var otp = document.getElementById('nk-otp').value.trim();
        var msg = document.getElementById('nk-verify-msg');
        if (otp.length !== 6) {
            msg.style.color = '#e56b6f';
            msg.innerText   = '⚠ 6 digit OTP daalo';
            return;
        }
        msg.style.color = '#40916c';
        msg.innerText   = '⏳ Verify ho raha hai...';

        $.post(NEKNAV.ajax_url, {
            action: 'neknav_verify_otp',
            nonce:  NEKNAV.nonce,
            otp:    otp
        }, function(res) {
            if (res.success) {
                msg.innerText = '✅ Mobile verify ho gaya! Redirect ho raha hai...';
                setTimeout(function(){ window.location.href = res.data.redirect; }, 1200);
            } else {
                msg.style.color = '#e56b6f';
                msg.innerText   = '⚠ ' + (res.data || 'OTP galat hai');
            }
        });
    };

    window.nkResend = function() {
        document.getElementById('nk-otp-step1').style.display = 'block';
        document.getElementById('nk-otp-step2').style.display = 'none';
        document.getElementById('nk-otp-msg').innerText = '';
    };

    // ── Referral Copy ────────────────────────────────────────────────────────
    window.nkCopyRef = function() {
        var url = document.getElementById('nk-ref-url');
        if (url) {
            navigator.clipboard.writeText(url.innerText).then(function(){
                var c = document.getElementById('nk-ref-copied');
                if (c) { c.style.display='block'; setTimeout(function(){ c.style.display='none'; }, 3000); }
            });
        }
    };

})(jQuery);
