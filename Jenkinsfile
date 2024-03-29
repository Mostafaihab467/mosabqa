pipeline {
    agent any
    environment {
        _PROJ_Name = 'mosabqa'
    }
    options {
        buildDiscarder(logRotator(numToKeepStr: '10', daysToKeepStr: '10', artifactNumToKeepStr: '10', artifactDaysToKeepStr: '10'))
        timeout(time: 100, unit: 'MINUTES')
        disableConcurrentBuilds()
    }
    stages {
        stage('Print Branch Name') {
            steps {
                script {
                    echo "Branch Name: ${env.GIT_BRANCH}"
                }
            }
        }
        stage('deploy sail branch') {
            steps {
                script {
                    if (env.GIT_BRANCH == 'origin/sail') {
                        echo "Deploying to sail branch."
                        sh '''
                            cd /var/www/mosabqasail
                            git config --global --add safe.directory /var/www/mosabqasail
                            git pull origin sail
                            sudo chmod 777 -R storage
                            exit
                        '''
                    }
                }
            }
        }
        stage('deploy master branch') {
            steps {
                script {
                    if (env.GIT_BRANCH == 'origin/master') {
                        echo "Deploying to master branch."
                        sh '''
                            cd /var/www/mosabqa
                            git config --global --add safe.directory /var/www/mosabqa
                            git pull origin master
                            php artisan queue:restart
                            sudo chmod 777 -R storage
                            exit
                        '''
                    }
                }
            }
        }
    }
}
