const ListComponent = {
  props: ["submenu"],
  template: `<ul v-if="submenu.length > 0" class="li-ul-container" ><span v-for="subItem in submenu"><li>{{subItem.name}}</li></span></ul>`
}