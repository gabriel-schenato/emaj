const Menu =  [
  { header: 'Informações' },
  {
    title: 'Dashboard',
    group: 'apps',
    icon: 'dashboard',
    name: 'Dashboard'
  },  
  { divider: true },
  { header: 'Cadastros do Sistema', role: ['admin', 'secretaria'] },
  {
    title: 'Cadastros',
    group: 'cadastro',
    component: 'cadastro',
    icon: 'add',
    itens: [
      { name: 'usuarios', title: 'Usuários', component: 'cadastro/usuarios', role: ['admin', 'secretaria'] },
      { name: 'clientes', title: 'Clientes', component: 'cadastro/clientes', role: ['admin', 'secretaria'] },
      { name: 'tipodemandas', title: 'Tipo de Demandas', component: 'cadastro/tipodemandas', role: ['admin', 'secretaria'] },
      { name: 'parametrostriagem', title: 'Parâmetros da Triagem', component: 'cadastro/parametrostriagem', role: ['admin'] }
    ],
    role: ['admin', 'secretaria']
  },
  { divider: true },
  { header: 'Movimentação do Sistema' },
  {
    title: 'Movimentos',
    group: 'movimentos',
    component: 'movimentos',
    icon: 'compare_arrows',
    itens: [
      { name: 'fichastriagem', title: 'Fichas de Triagem', component: 'movimentos/fichastriagem' },
    ]
  },  
  /*{ header: 'Estatísticas' },
  { divider: true },
  {
    title: 'Relatórios',
    group: 'forms',
    component: 'forms',
    icon: 'description',
    itens: [
    ]
  },*/
  { divider: true },
  { header: 'Extras' },
  {
    title: 'Alterações',
    group: 'apps',
    icon: 'new_releases',
    name: 'Alterações'
  }
];
// reorder menu
Menu.forEach((item) => {
  if (item.itens) {
    item.itens.sort((x, y) => {
      let textA = x.title.toUpperCase();
      let textB = y.title.toUpperCase();
      return (textA < textB) ? -1 : (textA > textB) ? 1 : 0;
    });
  }
});

export default Menu;
