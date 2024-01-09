const getdata = async (api) => {
    const results = await fetch (api)
    const data = await results.json();
    return data
 }
 let originaldata; 
 let currentPage = 1;
 let tope = 2;
 function previouspage(){
   currentPage --;
   fetchdata()  
 }
 function nextpage(){
     currentPage ++;
     fetchdata()  
    
 }
 function fetchdata (){
    let apiall = `https://reqres.in/api/users?page=${currentPage}`;
    console.log(apiall)
    getdata(apiall).then((data) => {
      originaldata = data
        renderdata(data)
    })
 }
//LOGICA PARA RENDERIZAR USUARIOS
function renderdata(data) {
  const contentuser = document.querySelector(".contentuser");
  contentuser.innerHTML = "";
    data.data.forEach(element => {
     
    contentuser.innerHTML += `<div class="card">
        <div class="centeruser">
            <div class="buttonUser">
                <button id="edit" onclick='edituser(${element.id})'><img src="./images/pencil-fill.svg" alt=""></button>
                <button id="delete" onclick="deleteUser(${element.id})"><img src="./images/trash3-fill.svg" alt=""></button>
              </div>

            <div class="centercontent">
                <img id="imgUser" src=${element.avatar} alt="">
                <h2>${element.first_name} ${element.last_name}</h2>
                <h3>${element.email}</h3>
           </div>

         </div>
      </div>`
   });
}
//LOGICA DE FILTRADO
const input = document.querySelector(".search");
input.addEventListener('keyup', (e) => {
  const searchTerm = e.target.value.toLowerCase();
  const filteredData = originaldata.data.filter(user =>
      user.first_name.toLowerCase().includes(searchTerm) ||
      user.last_name.toLowerCase().includes(searchTerm) ||
      user.email.toLowerCase().includes(searchTerm)
  );

  renderdata({ data: filteredData });
});
//LOGICA DE ELIMINACION DE USUARIO
function deleteUser(userId) {
  const userIndex = originaldata.data.findIndex(user => user.id === userId);

  if (userIndex !== -1) {
      originaldata.data.splice(userIndex, 1);
      renderdata(originaldata);

      console.log(`Usuario con ID ${userId} eliminado localmente`);
  } else {
      console.log(`No se encontró el usuario con ID ${userId}`);
  }
}
//LOGICA DE EDICION 
const popup = document.querySelector('.windowModal')
const contentpopup = document.querySelector('.contentpopup')

function edituser(userId) {
  popup.style.display = 'block'
  
    contentpopup.innerHTML += `<div id='inputEdit'>
    <h2>Editar</h2>
    <input type="text" placeholder="Edit name"><br>
    <input type="text" placeholder="Edit Email"><br>
    <button onclick='userEdit(${userId})'>EDITAR</button>
    </div>`
  
}
function confirmEdit(userId) {
  const editedName = document.getElementById('editName').value;
  const editedEmail = document.getElementById('editEmail').value;

  
  console.log(`Editando usuario con ID ${userId}`);
  console.log(`Nuevo nombre: ${editedName}`);
  console.log(`Nuevo email: ${editedEmail}`);

  // Cerrar el modal después de editar
  closeEditModal();
}
function closeEditModal() {
  popup.style.display = 'none';
  contentpopup.innerHTML = ''; // Limpiar contenido del modal
}
fetchdata()