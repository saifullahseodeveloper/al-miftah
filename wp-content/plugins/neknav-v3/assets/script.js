/* NekNeev v3 — Frontend JS */
(function($){

  // Password toggle
  window.nkEye = function(){
    var i=document.getElementById('nk-pass');
    if(i) i.type=i.type==='password'?'text':'password';
  };

  // Password strength
  var pp = document.getElementById('nk-pass');
  if(pp) pp.addEventListener('input', function(){
    var v=this.value, f=document.getElementById('nk-strength-fill');
    if(!f)return;
    var s=0;
    if(v.length>=8)s++;
    if(/[A-Z]/.test(v))s++;
    if(/[0-9]/.test(v))s++;
    if(/[^A-Za-z0-9]/.test(v))s++;
    f.style.background=['#e56b6f','#d4a017','#52b788','#1b4332'][s-1]||'#eee';
    f.style.width=['25%','50%','75%','100%'][s-1]||'0';
  });

  // Copy to clipboard
  window.nkCopy = function(text, btn){
    navigator.clipboard.writeText(text).then(function(){
      var orig = btn ? btn.innerText : '';
      if(btn){ btn.innerText='✅ Copied!'; btn.style.background='#c8e6c9'; }
      setTimeout(function(){ if(btn){btn.innerText=orig;btn.style.background='';} }, 2000);
    });
  };

  // Donate page: show payment panel
  window.nkShowPay = function(method){
    document.querySelectorAll('.nk-pay-panel').forEach(function(el){el.style.display='none';});
    document.querySelectorAll('.nk-pay-card').forEach(function(el){el.classList.remove('active');});
    var el=document.getElementById('nk-pay-'+method);
    if(el){el.style.display='block';el.scrollIntoView({behavior:'smooth',block:'start'});}
  };

  // Submit donation transaction
  window.nkSubmitTxn = function(btn, method){
    var box    = btn.closest('.nk-txn-form');
    var amount = box.querySelector('.nk-txn-amount').value;
    var txnid  = box.querySelector('.nk-txn-id').value;
    var note   = box.querySelector('.nk-txn-note').value;
    var ssFile = box.querySelector('.nk-txn-ss') ? box.querySelector('.nk-txn-ss').files[0] : null;
    var msg    = box.querySelector('.nk-txn-msg');
    if(!amount||parseFloat(amount)<=0){msg.innerHTML='<span style="color:red">⚠ Amount daalo</span>';return;}
    if(!txnid.trim()){msg.innerHTML='<span style="color:red">⚠ Transaction ID zaroori hai</span>';return;}
    msg.innerHTML='⏳ Submit ho raha hai...';
    btn.disabled=true;
    var fd=new FormData();
    fd.append('action','nk_submit_txn');
    fd.append('nonce',NK.nonce);
    fd.append('amount',amount);
    fd.append('txn_id',txnid);
    fd.append('method',method);
    fd.append('note',note);
    if(ssFile) fd.append('screenshot',ssFile);
    fetch(NK.ajax,{method:'POST',body:fd}).then(function(r){return r.json();}).then(function(d){
      if(d.success){msg.innerHTML='<span style="color:green;font-weight:700">✅ '+d.data.msg+'</span>';}
      else{msg.innerHTML='<span style="color:red">⚠ '+d.data+'</span>';btn.disabled=false;}
    });
  };

  // Document upload (dashboard)
  window.nkDocTab = function(type, btn){
    document.querySelectorAll('.nk-doc-form-box').forEach(function(el){el.style.display='none';});
    document.querySelectorAll('.nk-doc-tab').forEach(function(el){el.classList.remove('active');});
    var el=document.getElementById('nk-doc-'+type);
    if(el) el.style.display='block';
    if(btn) btn.classList.add('active');
  };

  window.nkUploadDoc = function(type){
    var file   = document.getElementById('nk-file-'+type);
    var num    = document.getElementById('nk-num-'+type);
    var msg    = document.getElementById('nk-msg-'+type);
    if(!file||!file.files[0]){msg.innerHTML='<span style="color:red">⚠ File select karein</span>';return;}
    msg.innerHTML='⏳ Upload ho raha hai...';
    var fd=new FormData();
    fd.append('action','nk_upload_doc');
    fd.append('nonce',NK.nonce);
    fd.append('doc_type',type);
    fd.append('doc_number',num?num.value:'');
    fd.append('doc_file',file.files[0]);
    fetch(NK.ajax,{method:'POST',body:fd}).then(function(r){return r.json();}).then(function(d){
      if(d.success){msg.innerHTML='<span style="color:green">✅ '+d.data.msg+'</span>';setTimeout(function(){location.reload();},1500);}
      else{msg.innerHTML='<span style="color:red">⚠ '+d.data+'</span>';}
    });
  };

})(jQuery);

  // Multi-eye toggle (for password tab)
  window.nkEyeToggle = function(id){
    var i=document.getElementById(id);
    if(i) i.type=i.type==='password'?'text':'password';
  };

  // Password strength for change-password form
  window.nkPassStrength2 = function(v){
    var fill  = document.getElementById('nk-str2-fill');
    var label = document.getElementById('nk-str2-label');
    if(!fill) return;
    var rules = {
      'r-len': v.length >= 8,
      'r-cap': /[A-Z]/.test(v),
      'r-num': /[0-9]/.test(v),
      'r-sym': /[^A-Za-z0-9]/.test(v),
    };
    var score = Object.values(rules).filter(Boolean).length;
    Object.keys(rules).forEach(function(id){
      var el = document.getElementById(id);
      if(el) el.className = 'nk-rule' + (rules[id] ? ' pass' : '');
    });
    var colors = ['#e56b6f','#d4a017','#52b788','#1b4332'];
    var labels = ['Kamzor','Theek Hai','Achha','Bahut Strong!'];
    fill.style.background = colors[score-1] || '#eee';
    fill.style.width = ['25%','50%','75%','100%'][score-1] || '0';
    if(label) label.innerText = score > 0 ? labels[score-1] : '';
  };

  // Confirm password match check
  window.nkMatchCheck = function(){
    var np = document.getElementById('nk-new-pass');
    var cp = document.getElementById('nk-conf-pass');
    var msg= document.getElementById('nk-match-msg');
    if(!np||!cp||!msg) return;
    if(cp.value.length === 0){ msg.innerText=''; return; }
    if(np.value === cp.value){
      msg.innerHTML='<span style="color:#40916c">✅ Passwords match kar rahe hain</span>';
    } else {
      msg.innerHTML='<span style="color:#e56b6f">⚠ Passwords alag hain</span>';
    }
  };
