let outer = [
    {id:1, name:'A'},
    {id:2, name:'B'},
    {id:3, name:'C'},
    {id:4, name:'D'},
];
console.log(outer)

console.log(outer[5])
// outer.splice(2,0,{id:5})
outer[5]={id:5}

console.log(outer)
