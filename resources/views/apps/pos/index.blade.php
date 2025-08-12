@extends('apps.layouts.main')

@section('content')
<!-- Add AlpineJS specifically for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.3/cdn.min.js" defer></script>

<div class="max-w-7xl mx-auto" x-data="posSystem()" x-init="init()">
    <!-- Alert Messages -->
    <div x-show="alert.show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mb-4 p-3 rounded-lg shadow-sm" 
         :class="alert.type === 'success' ? 'bg-purple-100 text-purple-800 border border-purple-200' : 'bg-yellow-100 text-red-800 border border-red-200'">
        <div class="flex items-center justify-between">
            <span x-text="alert.message"></span>
            <button @click="alert.show = false" class="ml-3 text-lg font-bold hover:opacity-70">&times;</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Menu Section -->
        <div class="lg:col-span-8">
            <!-- Filter Section -->
            <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col sm:flex-row gap-3">
                    <select x-model="filters.category" @change="filterMenus()" 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <option value="">Semua Kategori</option>
                        <template x-for="category in categories" :key="category.id">
                            <option :value="category.id" x-text="category.name"></option>
                        </template>
                    </select>
                    <input type="text" x-model="filters.search" @input="filterMenus()" 
                           placeholder="Cari menu..." 
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" />
                    <button @click="filterMenus()" 
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                </div>
            </div>

            <!-- Menu Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <template x-for="menu in filteredMenus" :key="menu.id">
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                        <div class="h-32 bg-gray-100 overflow-hidden">
                            <img :src="menu.image ? `/storage/${menu.image}` : '{{ asset('assets/img/nasgor.jpg') }}'" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-200" 
                                 :alt="menu.name" />
                        </div>
                        <div class="p-3">
                            <div class="font-semibold text-gray-800 text-sm mb-1" x-text="menu.name"></div>
                            <div class="text-sm text-gray-600 mb-3">
                                Rp <span x-text="formatNumber(menu.price)"></span>
                            </div>
                            <button @click="addToCart(menu)" 
                                    class="w-full py-2 text-sm bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg transition-colors duration-200">
                                <i class="fas fa-plus mr-1"></i> Tambah
                            </button>
                        </div>
                    </div>
                </template>
                
                <!-- Empty State -->
                <template x-if="filteredMenus.length === 0">
                    <div class="col-span-full text-center py-8">
                        <i class="fas fa-utensils text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Tidak ada menu yang ditemukan</p>
                    </div>
                </template>
            </div>
        </div>

        <!-- Cart Section -->
        <div class="lg:col-span-4">
            <div class="bg-white rounded-lg shadow-sm p-4 sticky top-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-shopping-cart mr-2"></i>Keranjang
                        <!-- <span x-show="cart.length > 0" 
                              class="ml-1 bg-yellow-100 text-red-800 text-xs px-2 py-1 rounded-full"
                              x-text="cart.length"></span> -->
                    </h2>
                    <button @click="clearCart()" 
                            x-show="cart.length > 0"
                            class="text-sm text-red-600 hover:text-red-800 transition-colors">
                        <i class="fas fa-trash mr-1"></i>Clear
                    </button>
                </div>

                <!-- Cart Items -->
                <div class="space-y-3 max-h-80 overflow-y-auto mb-4">
                    <template x-for="item in cart" :key="item.menu_id">
                        <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg">
                            <!-- <img :src="item.image ? `/storage/${item.image}` : '{{ asset('assets/img/nasgor.jpg') }}'" 
                                 class="w-12 h-12 rounded object-cover flex-shrink-0" /> -->
                            
                            <div class="flex-1 min-w-0">
                                <div class="text-sm font-medium text-gray-800 truncate" x-text="item.name"></div>
                                <div class="text-xs text-gray-500">
                                    Rp <span x-text="formatNumber(item.unit_price)"></span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-1">
                                <button @click="updateQuantity(item.menu_id, item.quantity - 1)"
                                        class="w-6 h-6 bg-gray-200 hover:bg-gray-300 rounded text-xs flex items-center justify-center">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="w-8 text-center text-sm font-medium" x-text="item.quantity"></span>
                                <button @click="updateQuantity(item.menu_id, item.quantity + 1)"
                                        class="w-6 h-6 bg-gray-200 hover:bg-gray-300 rounded text-xs flex items-center justify-center">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button @click="removeFromCart(item.menu_id)" 
                                        class="ml-2 text-red-600 hover:text-red-800 text-xs">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                    
                    <!-- Empty Cart -->
                    <template x-if="cart.length === 0">
                        <div class="text-center py-8">
                            <i class="fas fa-shopping-cart text-3xl text-gray-300 mb-2"></i>
                            <p class="text-sm text-gray-500">Keranjang masih kosong</p>
                        </div>
                    </template>
                </div>

                <!-- Cart Totals -->
                <div x-show="cart.length > 0" class="border-t pt-4 space-y-2">
                    <div class="flex justify-between text-sm hidden">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium">Rp <span x-text="formatNumber(totals.subtotal)"></span></span>
                    </div>
                    <div x-show="checkout.tax > 0" class="flex justify-between text-sm">
                        <span class="text-gray-600">Pajak</span>
                        <span>Rp <span x-text="formatNumber(checkout.tax)"></span></span>
                    </div>
                    <div x-show="checkout.discount > 0" class="flex justify-between text-sm">
                        <span class="text-gray-600">Diskon</span>
                        <span class="text-red-600">- Rp <span x-text="formatNumber(checkout.discount)"></span></span>
                    </div>
                    <div class="flex justify-between font-bold text-lg border-t pt-2">
                        <span>Total</span>
                        <span class="text-red-600">Rp <span x-text="formatNumber(totals.total)"></span></span>
                    </div>
                </div>

                <!-- Checkout Form -->
                <div x-show="cart.length > 0" class="mt-4 space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran</label>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Box Cash -->
                        <div 
                            @click="checkout.payment_method = 'cash'" 
                            :class="checkout.payment_method === 'cash' 
                                    ? 'border-red-500 ring-2 ring-red-500' 
                                    : 'border-gray-300'"
                            class="cursor-pointer border rounded-lg p-2 text-center hover:border-red-400 transition">
                            <div class=" font-semibold">Tunai</div>
                        </div>

                        <!-- Box QRIS -->
                        <div 
                            @click="checkout.payment_method = 'qris'" 
                            :class="checkout.payment_method === 'qris' 
                                    ? 'border-red-500 ring-2 ring-red-500' 
                                    : 'border-gray-300'"
                            class="cursor-pointer border rounded-lg p-2 text-center hover:border-red-400 transition">
                            <div class=" font-semibold">QRIS</div>
                        </div>
                    </div>
                </div>

                    
                    <div class="grid grid-cols-2 gap-3">
                        <div class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Pajak</label>
                            <input type="number" step="0.01" min="0" 
                                   x-model.number="checkout.tax" 
                                   @input="calculateTotals()"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   placeholder="0">
                        </div>
                        <div class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Diskon</label>
                            <input type="number" step="0.01" min="0" 
                                   x-model.number="checkout.discount" 
                                   @input="calculateTotals()"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   placeholder="0">
                        </div>
                    </div>
                    
                    <div x-show="checkout.payment_method === 'cash'">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Uang Diterima</label>
                        <input type="number" step="1" min="0" 
                               x-model.number="checkout.paid_amount" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                               :placeholder="formatNumber(totals.total)">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Pelanggan</label>
                        <textarea x-model="checkout.customer_notes" 
                                  rows="2" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                  placeholder="Catatan tambahan..."></textarea>
                    </div>
                    
                    <button @click="showCheckoutModal = true" 
                            class="w-full py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-medium transition-colors">
                        <i class="fas fa-cash-register mr-2"></i>Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Confirmation Modal -->
    <div x-show="showCheckoutModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        
        <div x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="scale-90 opacity-0"
             x-transition:enter-end="scale-100 opacity-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="scale-100 opacity-100"
             x-transition:leave-end="scale-90 opacity-0"
             class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-[70vh] overflow-y-auto">
            
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-receipt mr-2"></i>Konfirmasi Checkout
                    </h3>
                    <button @click="showCheckoutModal = false" 
                            class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Order Summary -->
                <div class="space-y-2 mb-4 max-h-32 overflow-y-auto">
                    <template x-for="item in cart" :key="item.menu_id">
                        <div class="flex justify-between text-sm py-1">
                            <span class="flex-1">
                                <span x-text="item.quantity"></span>x 
                                <span x-text="item.name"></span>
                            </span>
                            <span class="font-medium">Rp <span x-text="formatNumber(item.quantity * item.unit_price)"></span></span>
                        </div>
                    </template>
                </div>
                
                <!-- Payment Details -->
                <div class="border-t pt-4 space-y-2">
                    <div class="flex justify-between hidden text-sm">
                        <span>Subtotal:</span>
                        <span>Rp <span x-text="formatNumber(totals.subtotal)"></span></span>
                    </div>
                    <div x-show="checkout.tax > 0" class="flex justify-between hidden text-sm">
                        <span>Pajak:</span>
                        <span>Rp <span x-text="formatNumber(checkout.tax)"></span></span>
                    </div>
                    <div x-show="checkout.discount > 0" class="flex justify-between hidden text-sm">
                        <span>Diskon:</span>
                        <span class="text-red-600">- Rp <span x-text="formatNumber(checkout.discount)"></span></span>
                    </div>
                    <div class="flex justify-between font-bold text-lg border-t pt-2">
                        <span>Total:</span>
                        <span class="text-red-600">Rp <span x-text="formatNumber(totals.total)"></span></span>
                    </div>
                    
                    <div class="flex justify-between text-sm">
                        <span>Pembayaran:</span>
                        <span x-text="checkout.payment_method === 'cash' ? 'Tunai' : 'QRIS'"></span>
                    </div>
                    
                    <template x-if="checkout.payment_method === 'cash'">
                        <div>
                            <div class="flex justify-between text-sm">
                                <span>Uang Diterima:</span>
                                <span>Rp <span x-text="formatNumber(checkout.paid_amount || 0)"></span></span>
                            </div>
                            <div class="flex justify-between font-semibold" 
                                 :class="change >= 0 ? 'text-green-600' : 'text-red-600'">
                                <span>Kembalian:</span>
                            </div>
                            <div class="w-full p-3 border-2 border-dashed border-green-500 shadow rounded flex justify-center">
                                <span x-text="formatNumber(change)" class="text-3xl text-center font-bold mx-auto"></span>
                            </div>
                            <div x-show="change < 0" class="text-red-600 text-sm mt-1 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Uang tidak cukup!
                            </div>
                        </div>
                    </template>
                </div>

                
                
                <!-- Action Buttons -->
                <div class="flex gap-3 mt-6">
                    <button @click="showCheckoutModal = false" 
                            class="flex-1 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button @click="processCheckout()" 
                            :disabled="checkout.payment_method === 'cash' && change < 0"
                            class="flex-1 py-2 bg-purple-600 hover:bg-purple-700 disabled:bg-gray-400 text-white rounded-lg transition-colors">
                        <span x-show="!processing">
                            <i class="fas fa-save mr-1"></i>Simpan
                        </span>
                        <span x-show="processing">
                            <i class="fas fa-spinner fa-spin mr-1"></i>Memproses...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function posSystem() {
        return {
            // Data from Laravel backend
            menus: @json($menus),
            categories: @json($categories),
            
            cart: [],
            filteredMenus: [],
            filters: {
                category: '',
                search: ''
            },
            checkout: {
                payment_method: 'cash',
                tax: 0,
                discount: 0,
                paid_amount: 0,
                customer_notes: ''
            },
            totals: {
                subtotal: 0,
                total: 0
            },
            showCheckoutModal: false,
            processing: false,
            alert: {
                show: false,
                message: '',
                type: 'success'
            },

            init() {
                this.filteredMenus = [...this.menus];
                this.calculateTotals();
                console.log('POS System initialized');
            },

            get change() {
                if (this.checkout.payment_method === 'cash') {
                    return (this.checkout.paid_amount || 0) - this.totals.total;
                }
                return 0;
            },

            addToCart(menu) {
                const existingItem = this.cart.find(item => item.menu_id === menu.id);
                
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    this.cart.push({
                        menu_id: menu.id,
                        name: menu.name,
                        image: menu.image,
                        unit_price: parseFloat(menu.price),
                        quantity: 1
                    });
                }
                
                this.calculateTotals();
                this.showAlert('Item ditambahkan ke keranjang', 'success');
            },

            updateQuantity(menuId, newQuantity) {
                if (newQuantity <= 0) {
                    this.removeFromCart(menuId);
                    return;
                }
                
                const item = this.cart.find(item => item.menu_id === menuId);
                if (item) {
                    item.quantity = newQuantity;
                    this.calculateTotals();
                }
            },

            removeFromCart(menuId) {
                this.cart = this.cart.filter(item => item.menu_id !== menuId);
                this.calculateTotals();
                this.showAlert('Item dihapus dari keranjang', 'success');
            },

            clearCart() {
                if (confirm('Kosongkan keranjang?')) {
                    this.cart = [];
                    this.calculateTotals();
                    this.showAlert('Keranjang dikosongkan', 'success');
                }
            },

            calculateTotals() {
                this.totals.subtotal = this.cart.reduce((sum, item) => {
                    return sum + (item.unit_price * item.quantity);
                }, 0);
                
                this.totals.total = this.totals.subtotal + (this.checkout.tax || 0) - (this.checkout.discount || 0);
            },

            filterMenus() {
                this.filteredMenus = this.menus.filter(menu => {
                    const matchesCategory = !this.filters.category || menu.category_id == this.filters.category;
                    const matchesSearch = !this.filters.search || 
                        menu.name.toLowerCase().includes(this.filters.search.toLowerCase());
                    return matchesCategory && matchesSearch;
                });
            },

            async processCheckout() {
                if (this.cart.length === 0) {
                    this.showAlert('Keranjang kosong', 'error');
                    return;
                }

                if (this.checkout.payment_method === 'cash' && this.change < 0) {
                    this.showAlert('Uang tidak cukup', 'error');
                    return;
                }

                this.processing = true;

                const checkoutData = {
                    cart: this.cart,
                    payment_method: this.checkout.payment_method,
                    tax: this.checkout.tax || 0,
                    discount: this.checkout.discount || 0,
                    paid_amount: this.checkout.payment_method === 'cash' ? 
                        (this.checkout.paid_amount || 0) : this.totals.total,
                    customer_notes: this.checkout.customer_notes,
                    subtotal: this.totals.subtotal,
                    total: this.totals.total,
                    change_amount: Math.max(0, this.change)
                };

                try {
                    const response = await fetch('{{ route("apps.pos.checkout") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(checkoutData)
                    });

                    const result = await response.json();

                    if (response.ok && result.success) {
                        this.cart = [];
                        this.checkout = {
                            payment_method: 'cash',
                            tax: 0,
                            discount: 0,
                            paid_amount: 0,
                            customer_notes: ''
                        };
                        this.calculateTotals();
                        this.showCheckoutModal = false;
                        this.showAlert(result.message, 'success');
                    } else {
                        this.showAlert(result.message || 'Terjadi kesalahan', 'error');
                    }
                } catch (error) {
                    console.error('Checkout error:', error);
                    this.showAlert('Terjadi kesalahan jaringan', 'error');
                }

                this.processing = false;
            },

            showAlert(message, type = 'success') {
                this.alert = {
                    show: true,
                    message: message,
                    type: type
                };
                
                setTimeout(() => {
                    this.alert.show = false;
                }, 5000);
            },

            formatNumber(number) {
                return new Intl.NumberFormat('id-ID').format(number || 0);
            }
        }
    }
</script>
@endsection