//Script.js là các tương tác cơ bản cho Genus Gaming
//Điều hướng nút Đăng ký
//Slider hero đơn giản
//Chuyển đổi form đăng ký hoặc đăng nhập
//Bắt sự kiện submit form (giả lập, frontend only)

//Nút đăng ký trên header --> auth.html
document.getElementById('authBtn')?.addEventListener('click', () => { window.location.href = 'auth.html'; });
document.getElementById('authBtn2')?.addEventListener('click', () => { window.location.href = 'auth.html'; });
document.getElementById('authBtn3')?.addEventListener('click', () => { window.location.href = 'auth.html'; });
document.getElementById('authBtn4')?.addEventListener('click', () => { window.location.href = 'auth.html'; });

// Simple hero slider (auto rotate) index.html
(function(){
  try{
    const slides = document.querySelectorAll('.hero-slide');
    if(!slides || slides.length===0) return;
    let i = 0;
    slides.forEach((s, idx)=> s.setAttribute('aria-hidden', idx===0 ? 'false' : 'true'));
    setInterval(()=>{
      slides[i].setAttribute('aria-hidden', 'true');
      i = (i+1) % slides.length;
      slides[i].setAttribute('aria-hidden', 'false');
    }, 4500);
  }catch(e){console.warn('Slider error', e)}
})();

//Smooth scroll for internal anchors (F&B sticky menu)
document.querySelectorAll('a[href^="#"]').forEach(a=>{
  a.addEventListener('click', function(e){
    const target = document.querySelector(this.getAttribute('href'));
    if(target){ e.preventDefault(); target.scrollIntoView({behavior:'smooth', block:'start'}); }
  });
});

//Auth page: show/hide login & register forms
(function(){
  const regBox = document.getElementById('registerBox');
  const loginBox = document.getElementById('loginBox');
  document.getElementById('toLogin')?.addEventListener('click', (e)=>{
    e.preventDefault(); regBox.classList.add('hidden'); loginBox.classList.remove('hidden');
  });
  document.getElementById('toRegister')?.addEventListener('click', (e)=>{
    e.preventDefault(); loginBox.classList.add('hidden'); regBox.classList.remove('hidden');
  });

  //Handle fake submit for demo purposes (frontend-only)
  document.getElementById('registerForm')?.addEventListener('submit', function(e){
    e.preventDefault();
    alert('Đăng ký thành công (mẫu). Để hoạt động thực sự, tích hợp backend.');
    //reset form
    this.reset();
  });
  document.getElementById('loginForm')?.addEventListener('submit', function(e){
    e.preventDefault();
    alert('Đăng nhập thành công (mẫu). Để hoạt động thực sự, tích hợp backend.');
    this.reset();
  });
})();

console.log('script.js loaded');