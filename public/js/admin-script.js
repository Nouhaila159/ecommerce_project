/**Description: Ecommerce Admin Panel
 * author: Mohammed Sefat Ullah
 * Date: 17 Oct, 2022
*/
   // Active Nav 
   // currentPage Name 
   let currentPage = window.location.pathname.split("/").pop();
       currentPage = "./" + currentPage;
   const navItem = document.querySelectorAll('#sidebar-container ul li a');

   navItem.forEach((item) => {
      // target li 
      let listItem = item.parentNode;
      let href = item.getAttribute('href');
      // add active class 
      if(currentPage == href) {
         listItem.classList.add('active-admin-nav');
      }    
   });