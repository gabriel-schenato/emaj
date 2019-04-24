import Vue from "vue";
import moment from 'moment'
        moment.locale('pt-BR');

Vue.filter('formataDataEscrita', function (value) {
    if (value) {
        return moment(String(value)).format('LLL');
    }
});

Vue.filter('formataDataComDiaNafrente', function (value) {
    if (value) {
        return moment(String(value)).format('LLLL');
    }
});

Vue.filter('formataData', function (value) {
    if (value) {
        return moment(String(value)).format('L LTS');
    }
});

Vue.filter('formataRole', function (value) {
    if (value) {
        switch (value) {
            case 'admin':
                return 'Administrador';
            case 'secretaria':
                return 'Secretária';
            case 'aluno':
                return 'Aluno';
        }
    }
});