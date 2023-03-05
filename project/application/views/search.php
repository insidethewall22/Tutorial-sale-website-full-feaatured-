
    <div class="container home">
        <p class="welcome"> Search Tutorials</p>
        
        <div class="row avatar">
            <div >
                <div class="form-group avatar-button">
                    <input type="text"  name="search" id = "search"  class="form-control"/>
				</div>
                <div id="result"></div>

			
                
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            load_data();
            function load_data(query){
                $.ajax({
                    url:"<?php echo base_url(); ?>"Search/fetch",
                    method:"POST",
                    data:{query:query},
                    success:function(data){
                        $('#result').html(data);
                    }
                })
            }
            $('#search').keyup(function(){
                var search = $(this).val();
                if(search != ''){
                    load_data(search);

                }else{
                    load_data();
                }

            });
        });
    </script>

</body>
</html>