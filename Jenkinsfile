pipeline {
  agent any
  environment {
    _PROJ_Name = 'mosabqa'
  }
  options {
    buildDiscarder(logRotator(numToKeepStr: '10', daysToKeepStr: '10', artifactNumToKeepStr: '10', artifactDaysToKeepStr: '10'))
    timeout(time: 5, unit: 'MINUTES')
    disableConcurrentBuilds()
  }
  stages {
    stage('deploy sail branch') {
      steps {
        script {
          if (env.BRANCH_NAME == 'sail') {
            sh '''
              cd /var/www/mosabqasail
              git config --global --add safe.directory /var/www/mosabqasail
              git pull origin sail
              php artisan queue:restart
              sudo chmod 777 -R storage
            '''
          }
        }
      }
    }
    stage('deploy master branch') {
      steps {
        script {
          if (env.BRANCH_NAME == 'master') {
            sh '''
              cd /var/www/mosabqa
              git config --global --add safe.directory /var/www/mosabqa
              git pull origin master
              php artisan queue:restart
              sudo chmod 777 -R storage
            '''
          }
        }
      }
    }
  }
}
