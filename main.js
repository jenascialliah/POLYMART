function filterProducts(category) {
 const chosen={all:['all-products','exam-products','lifestyle-products','merch-products'],popular:['all-products'],exam:['exam-products'],lifestyle:['lifestyle-products'],merch:['merch-products']}[category]||['all-products'];
 document.querySelectorAll('.products-grid').forEach(g=>{g.classList.toggle('active',chosen.includes(g.id));g.querySelectorAll('.product-card').forEach(c=>c.hidden=false);});
 document.getElementById('Products')?.scrollIntoView({behavior:'smooth'});
}
function searchProducts(q){
 filterProducts('all'); const needle=q.toLowerCase(); const seen=new Set(); let count=0;
 document.querySelectorAll('.product-card').forEach(c=>{const name=c.querySelector('h3')?.textContent.trim().toLowerCase()||'';const match=c.textContent.toLowerCase().includes(needle)&&!seen.has(name);c.hidden=!match;if(match){seen.add(name);count++;}});
 let msg=document.getElementById('search-status');if(!msg){msg=document.createElement('p');msg.id='search-status';document.getElementById('Products').prepend(msg);}msg.textContent=q?`${count} product(s) matching “${q}”`:'';
}
document.addEventListener('DOMContentLoaded',()=>{const q=new URLSearchParams(location.search).get('q');if(q)searchProducts(q);});
document.querySelectorAll('.view-item-btn').forEach(button=>button.addEventListener('click',()=>{
 document.getElementById('modalName').textContent=button.dataset.name;
 document.getElementById('modalPrice').textContent=button.dataset.price;
 document.getElementById('modalDescription').textContent=button.dataset.description;
 document.getElementById('modalImage').src=safeImage(button.dataset.image);
 document.getElementById('quantity').value=1;
 document.getElementById('productModal').style.display='flex';
}));
document.getElementById('closeModalBtn')?.addEventListener('click',()=>{document.getElementById('productModal').style.display='none';});
document.querySelectorAll('.quantity-btn').forEach(btn=>btn.addEventListener('click',()=>{const i=document.getElementById('quantity');i.value=Math.max(1,Math.min(99,Number(i.value)+Number(btn.dataset.change)));}));
