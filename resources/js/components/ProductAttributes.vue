<template>
    <div>
        <div class="tile">
            <h3 class="tile-titl">Attributes</h3>
            <hr />
            <div class="tile-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                                Select an Attribute
                                <span class="text-danger m-l-5"> *</span>
                            </label>
                            <select
                                id="attribute"
                                v-model="attribute"
                                class="custom-select form-control mt-15"
                                @change="selectAttribute(attribute)"
                            >
                                <option
                                    :value="attribute"
                                    v-for="attribute in attributes"
                                    :key="attribute.id"
                                >
                                    {{ attribute.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tile" v-if="attributeSelected">
            <h3 class="tile-title">Add Attributes To Product</h3>
            <div class="tile-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>
                                Select a Value
                                <span class="m-l-5 text-danger"> *</span>
                            </label>
                            <select 
                                id="values"
                                v-model="value"
                                class="form-control custom-select mt-15"
                                @change="selectValue(value)"
                            >
                                <option
                                    :value="value"
                                    v-for="value in attributeValues"
                                    :key="value.id"
                                >
                                    {{ value.value }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" v-if="valueSelected">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="quantity">
                                Quantity
                                <span class="text-danger m-l-5"> *</span>
                            </label>
                            <input 
                                type="number" 
                                v-model="quantity" 
                                id="quantity"
                                class="form-control"
                            >
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" @click.prevent="addProductAttribute()">
                                <i class="fa fa-plus"></i> Add Attribute
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tile">
            <h3 class="tile-title">Product Attributes</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-center">
                                <th>Quantity</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="pa in productAttributes" :key="pa.id">
                                <td style="width: 25%" class="text-center">
                                    {{ pa.quantity }}
                                </td>
                                <td style="width: 25%" class="text-center">
                                    {{ pa.value }}
                                </td>
                                <td style="width: 25%" class="text-center">
                                    <button 
                                        class="btn btn-sm btn-danger" 
                                        @click.prevent="deleteProductAttribute(pa)"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'product-attributes',
    props: ['productid'],
    data() {
        return {
            attribute: {},
            attributes: [],
            productAttributes: [],
            attributeSelected: false,
            value: {},
            attributeValues: [],
            valueSelected: false,
            currentValue: '',
            quantity: '',
            currentAttributeId: '',
        }
    },
    created() {
        this.loadAttributes();
        this.loadProductAttributes(this.productid);
    },
    methods: {
        loadProductAttributes (id) {
            axios.post('/admin/products/attributes', {
                id: id
            })
            .then(response => {
                this.productAttributes = response.data;
            })
            .catch(error => {
                console.log(error);
            })
        },
        loadAttributes () {
            axios.get('/admin/products/attributes/load')
                .then(response => {
                    this.attributes = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        selectAttribute (attribute) {

            this.currentAttributeId = attribute.id;

            axios.post('/admin/products/attribute/values', {
                id: attribute.id
            })
            .then(response => {
                this.attributeValues = response.data;
            })
            .catch(error => {
                console.log(error);
            })

            this.attributeSelected = true;
        },
        selectValue (value) {
            this.valueSelected = true;
            this.currentValue = value.value;
            this.quantity = value.quantity;
        },
        addProductAttribute () {
            let data = {
                value: this.currentValue,
                quantity: this.quantity,
                product_id: this.productid,
                attribute_id: this.currentAttributeId
            };

            if (!this.quantity) {
                return this.$swal('Error, something went wrong', {
                    icon: 'error'
                });
            }

            axios.post('/admin/products/attribute/addProductAttribute', {
                data: data
            })
            .then(response => {
                this.$swal('Success ' + response.data.message, {
                    icon: 'success'
                })
                this.valueSelected = false;
                this.loadProductAttributes(this.productid);
            })
            .catch(error => {
                console.log(error);
            })
        },
        deleteProductAttribute (pa) {
            this.$swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    //console.log(pa.id);
                    axios.post('/admin/products/attribute/deleteProductAttribute', {
                        id: pa.id
                    })
                    .then(response => {
                        if (response.data.status === 'success') {
                            this.$swal('Success ' + response.data.message, {
                                icon: 'success'
                            })
                            //this.loadProductAttributes(this.productid);
                            this.productAttributes.splice(this.productAttributes.indexOf(pa), 1);
                        } else {
                            this.$swal('Something went wrong.')
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
                } else {
                    this.$swal("Action cancelled!");
                }
            })
        }
    },
}
</script>