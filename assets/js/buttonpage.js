
const table = {
                'column' : 'brand_name',
                'keyword' : '', 
                'perPage' : 10,
                'pageSelect' : 1, 
                'name' : 'Merk',
                'id' : null
            };

const meta = [];

function meta()
{
    
}

function pagebutton(data)
{
    const page = {};
    if(data > 5 && (data - 5) >  1){
        if(table.pageSelect > 5 && table.pageSelect > 5 && table.pageSelect < (data - 3)){
            page[0] = {'page' : 1}
            page[1] = {'page' : '...'}
            page[2] = {'page' : table.pageSelect}
            page[3] = {'page' : '...'}
            page[4] = {'page' : data}

            return page;
        }else if(table.pageSelect == data){
            page[0] = {'page' : 1}
            page[1] = {'page' : '...'}
            for (let i = 2; i < 6; i++) {
            page[i]= {'page' : i+(data - 5)};
            }
            return page;
        }else if(table.pageSelect >= (data - 3) && table.pageSelect < data){
            page[0] = {'page' : 1}
            page[1] = {'page' : '...'}
            for (let i = 2; i < 6; i++) {
            page[i]= {'page' : i+(data - 5)};
            }
            return page;
        }else{
            for (let i = 0; i < 5; i++) {
            page[i]= {'page' : i+1};
            }
            page[5] = {'page' : '...'}
            page[6] = {'page' : data}
            return page;
        }
    }else{
        for (let i = 0; i < 2; i++) {
            page[i]= {'page' : i+1};
        }
        return page;
    }
}

