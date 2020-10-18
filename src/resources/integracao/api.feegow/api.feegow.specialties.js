class ApiFeegowSpecialties {

    apiFeegow = null;
    
    constructor(){
         this.apiFeegow = new ApiFeegow();    
    }

    /**
     * Lista todas especialidades disponíveis para agendamento.
     */
    list(){
        return this.apiFeegow.get('specialties/list', null);
    }

}